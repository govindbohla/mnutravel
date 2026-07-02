<?php

namespace App\Services;

use App\Models\Gallery;
use App\Repositories\Contracts\GalleryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class GalleryService
{
    public function __construct(
        protected GalleryRepositoryInterface $repository,
        protected ImageUploadService $imageUploadService,
    ) {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data, ?UploadedFile $image): Gallery
    {
        if ($image) {
            $data['image'] = $this->imageUploadService->upload($image, 'gallery');
        }

        /** @var Gallery $item */
        $item = $this->repository->create($data);

        return $item;
    }

    public function update(Gallery $item, array $data, ?UploadedFile $image): Gallery
    {
        if ($image) {
            $data['image'] = $this->imageUploadService->upload($image, 'gallery', replacePath: $item->image);
        }

        /** @var Gallery $updated */
        $updated = $this->repository->update($item, $data);

        return $updated;
    }

    public function delete(Gallery $item): bool
    {
        return $this->repository->delete($item);
    }
}
