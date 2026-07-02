<?php

namespace App\Repositories\Eloquent;

use App\Models\HeroSlider;
use App\Repositories\Contracts\HeroSliderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class HeroSliderRepository extends BaseRepository implements HeroSliderRepositoryInterface
{
    public function __construct(HeroSlider $model)
    {
        parent::__construct($model);
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->model->newQuery()->orderBy('sort_order')->get($columns);
    }
}
