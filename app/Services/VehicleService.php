<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Repositories\Contracts\VehicleRepositoryInterface;
use App\Traits\GeneratesUniqueSlug;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class VehicleService
{
    use GeneratesUniqueSlug;

    public function __construct(
        protected VehicleRepositoryInterface $repository,
        protected ImageUploadService $imageUploadService,
    ) {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data, ?UploadedFile $image, array $galleryImages = []): Vehicle
    {
        $data['slug'] = $this->uniqueSlug(Vehicle::class, $data['name']);

        if ($image) {
            $data['image'] = $this->imageUploadService->upload($image, 'vehicles');
        }

        /** @var Vehicle $vehicle */
        $vehicle = $this->repository->create($data);

        $this->attachGallery($vehicle, $galleryImages);

        return $vehicle;
    }

    public function update(Vehicle $vehicle, array $data, ?UploadedFile $image, array $galleryImages = []): Vehicle
    {
        if ($data['name'] !== $vehicle->name) {
            $data['slug'] = $this->uniqueSlug(Vehicle::class, $data['name'], $vehicle->id);
        }

        if ($image) {
            $data['image'] = $this->imageUploadService->upload($image, 'vehicles', replacePath: $vehicle->image);
        }

        /** @var Vehicle $updated */
        $updated = $this->repository->update($vehicle, $data);

        $this->attachGallery($updated, $galleryImages);

        return $updated;
    }

    public function delete(Vehicle $vehicle): bool
    {
        return $this->repository->delete($vehicle);
    }

    public function deleteGalleryImage(VehicleImage $image): void
    {
        $this->imageUploadService->delete($image->image_path);
        $image->delete();
    }

    protected function attachGallery(Vehicle $vehicle, array $galleryImages): void
    {
        foreach ($galleryImages as $image) {
            if (! $image instanceof UploadedFile) {
                continue;
            }

            $vehicle->images()->create([
                'image_path' => $this->imageUploadService->upload($image, 'vehicles/gallery'),
            ]);
        }
    }
}
