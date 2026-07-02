<?php

namespace App\Services;

use App\Models\Service;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Traits\GeneratesUniqueSlug;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class ServiceService
{
    use GeneratesUniqueSlug;

    public function __construct(
        protected ServiceRepositoryInterface $repository,
        protected ImageUploadService $imageUploadService,
    ) {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data, ?UploadedFile $image): Service
    {
        $data['slug'] = $this->uniqueSlug(Service::class, $data['name']);

        if ($image) {
            $data['image'] = $this->imageUploadService->upload($image, 'services');
        }

        /** @var Service $service */
        $service = $this->repository->create($data);

        return $service;
    }

    public function update(Service $service, array $data, ?UploadedFile $image): Service
    {
        if ($data['name'] !== $service->name) {
            $data['slug'] = $this->uniqueSlug(Service::class, $data['name'], $service->id);
        }

        if ($image) {
            $data['image'] = $this->imageUploadService->upload($image, 'services', replacePath: $service->image);
        }

        /** @var Service $updated */
        $updated = $this->repository->update($service, $data);

        return $updated;
    }

    public function delete(Service $service): bool
    {
        return $this->repository->delete($service);
    }
}
