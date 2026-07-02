<?php

namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    public function paginateFiltered(array $filters, int $perPage = 20): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->withCount(['bookings', 'enquiries'])
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }
}
