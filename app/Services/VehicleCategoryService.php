<?php

namespace App\Services;

use App\Models\VehicleCategory;
use App\Repositories\Contracts\VehicleCategoryRepositoryInterface;
use App\Traits\GeneratesUniqueSlug;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class VehicleCategoryService
{
    use GeneratesUniqueSlug;

    public function __construct(
        protected VehicleCategoryRepositoryInterface $repository,
        protected ImageUploadService $imageUploadService,
    ) {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data, ?UploadedFile $image): VehicleCategory
    {
        $data['slug'] = $this->uniqueSlug(VehicleCategory::class, $data['name']);

        if ($image) {
            $data['image'] = $this->imageUploadService->upload($image, 'vehicle-categories');
        }

        /** @var VehicleCategory $category */
        $category = $this->repository->create($data);

        return $category;
    }

    public function update(VehicleCategory $category, array $data, ?UploadedFile $image): VehicleCategory
    {
        if ($data['name'] !== $category->name) {
            $data['slug'] = $this->uniqueSlug(VehicleCategory::class, $data['name'], $category->id);
        }

        if ($image) {
            $data['image'] = $this->imageUploadService->upload($image, 'vehicle-categories', replacePath: $category->image);
        }

        /** @var VehicleCategory $updated */
        $updated = $this->repository->update($category, $data);

        return $updated;
    }

    public function delete(VehicleCategory $category): bool
    {
        return $this->repository->delete($category);
    }
}
