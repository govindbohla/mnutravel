<?php

namespace App\Repositories\Eloquent;

use App\Models\Enquiry;
use App\Repositories\Contracts\EnquiryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EnquiryRepository extends BaseRepository implements EnquiryRepositoryInterface
{
    public function __construct(Enquiry $model)
    {
        parent::__construct($model);
    }

    public function paginateFiltered(array $filters, int $perPage = 20): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->with('customer')
            ->when($filters['status'] ?? null, fn ($q, $status) => $q->where('status', $status))
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
