<?php

namespace App\Services;

use App\Models\Testimonial;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class TestimonialService
{
    public function __construct(
        protected TestimonialRepositoryInterface $repository,
        protected ImageUploadService $imageUploadService,
    ) {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data, ?UploadedFile $image): Testimonial
    {
        if ($image) {
            $data['image'] = $this->imageUploadService->upload($image, 'testimonials');
        }

        /** @var Testimonial $testimonial */
        $testimonial = $this->repository->create($data);

        return $testimonial;
    }

    public function update(Testimonial $testimonial, array $data, ?UploadedFile $image): Testimonial
    {
        if ($image) {
            $data['image'] = $this->imageUploadService->upload($image, 'testimonials', replacePath: $testimonial->image);
        }

        /** @var Testimonial $updated */
        $updated = $this->repository->update($testimonial, $data);

        return $updated;
    }

    public function delete(Testimonial $testimonial): bool
    {
        return $this->repository->delete($testimonial);
    }
}
