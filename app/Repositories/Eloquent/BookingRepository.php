<?php

namespace App\Repositories\Eloquent;

use App\Models\Booking;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    public function __construct(Booking $model)
    {
        parent::__construct($model);
    }

    public function paginateFiltered(array $filters, int $perPage = 20): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->with(['vehicle', 'customer'])
            ->when($filters['status'] ?? null, fn ($q, $status) => $q->where('status', $status))
            ->when($filters['trip_type'] ?? null, fn ($q, $type) => $q->where('trip_type', $type))
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('booking_no', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('pickup_location', 'like', "%{$search}%")
                        ->orWhere('drop_location', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }
}
