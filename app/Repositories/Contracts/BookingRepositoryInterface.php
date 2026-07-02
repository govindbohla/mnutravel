<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BookingRepositoryInterface extends BaseRepositoryInterface
{
    public function paginateFiltered(array $filters, int $perPage = 20): LengthAwarePaginator;
}
