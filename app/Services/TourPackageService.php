<?php

namespace App\Services;

use App\Models\TourPackage;
use App\Models\TourPackageImage;
use App\Repositories\Contracts\TourPackageRepositoryInterface;
use App\Traits\GeneratesUniqueSlug;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class TourPackageService
{
    use GeneratesUniqueSlug;

    public function __construct(
        protected TourPackageRepositoryInterface $repository,
        protected ImageUploadService $imageUploadService,
    ) {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data, ?UploadedFile $image, array $galleryImages = []): TourPackage
    {
        $data['slug'] = $this->uniqueSlug(TourPackage::class, $data['name']);

        if ($image) {
            $data['featured_image'] = $this->imageUploadService->upload($image, 'tour-packages');
        }

        /** @var TourPackage $package */
        $package = $this->repository->create($data);

        $this->attachGallery($package, $galleryImages);

        return $package;
    }

    public function update(TourPackage $package, array $data, ?UploadedFile $image, array $galleryImages = []): TourPackage
    {
        if ($data['name'] !== $package->name) {
            $data['slug'] = $this->uniqueSlug(TourPackage::class, $data['name'], $package->id);
        }

        if ($image) {
            $data['featured_image'] = $this->imageUploadService->upload($image, 'tour-packages', replacePath: $package->featured_image);
        }

        /** @var TourPackage $updated */
        $updated = $this->repository->update($package, $data);

        $this->attachGallery($updated, $galleryImages);

        return $updated;
    }

    public function delete(TourPackage $package): bool
    {
        return $this->repository->delete($package);
    }

    public function deleteGalleryImage(TourPackageImage $image): void
    {
        $this->imageUploadService->delete($image->image_path);
        $image->delete();
    }

    protected function attachGallery(TourPackage $package, array $galleryImages): void
    {
        foreach ($galleryImages as $image) {
            if (! $image instanceof UploadedFile) {
                continue;
            }

            $package->images()->create([
                'image_path' => $this->imageUploadService->upload($image, 'tour-packages/gallery'),
            ]);
        }
    }
}
