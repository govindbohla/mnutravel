<?php

namespace App\Services;

use App\Models\HeroSlider;
use App\Repositories\Contracts\HeroSliderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class HeroSliderService
{
    public function __construct(
        protected HeroSliderRepositoryInterface $repository,
        protected ImageUploadService $imageUploadService,
    ) {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data, ?UploadedFile $image): HeroSlider
    {
        if ($image) {
            $data['image'] = $this->imageUploadService->upload($image, 'hero-sliders', maxWidth: 1920);
        }

        /** @var HeroSlider $slider */
        $slider = $this->repository->create($data);

        return $slider;
    }

    public function update(HeroSlider $slider, array $data, ?UploadedFile $image): HeroSlider
    {
        if ($image) {
            $data['image'] = $this->imageUploadService->upload($image, 'hero-sliders', maxWidth: 1920, replacePath: $slider->image);
        }

        /** @var HeroSlider $updated */
        $updated = $this->repository->update($slider, $data);

        return $updated;
    }

    public function delete(HeroSlider $slider): bool
    {
        return $this->repository->delete($slider);
    }
}
