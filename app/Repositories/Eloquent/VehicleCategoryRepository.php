<?php

namespace App\Repositories\Eloquent;

use App\Models\VehicleCategory;
use App\Repositories\Contracts\VehicleCategoryRepositoryInterface;

class VehicleCategoryRepository extends BaseRepository implements VehicleCategoryRepositoryInterface
{
    public function __construct(VehicleCategory $model)
    {
        parent::__construct($model);
    }
}
