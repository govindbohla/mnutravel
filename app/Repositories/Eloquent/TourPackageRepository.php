<?php

namespace App\Repositories\Eloquent;

use App\Models\TourPackage;
use App\Repositories\Contracts\TourPackageRepositoryInterface;

class TourPackageRepository extends BaseRepository implements TourPackageRepositoryInterface
{
    public function __construct(TourPackage $model)
    {
        parent::__construct($model);
    }
}
