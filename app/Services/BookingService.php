<?php

namespace App\Services;

use App\Models\Booking;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class BookingService
{
    public function __construct(protected BookingRepositoryInterface $repository)
    {
    }

    public function paginate(array $filters, int $perPage = 20): LengthAwarePaginator
    {
        return $this->repository->paginateFiltered($filters, $perPage);
    }

    public function find(int $id): Booking
    {
        /** @var Booking $booking */
        $booking = $this->repository->findOrFail($id);

        return $booking;
    }

    public function create(array $data): Booking
    {
        $data['booking_no'] = $this->generateBookingNo();

        /** @var Booking $booking */
        $booking = $this->repository->create($data);

        return $booking;
    }

    public function update(Booking $booking, array $data): Booking
    {
        /** @var Booking $updated */
        $updated = $this->repository->update($booking, $data);

        return $updated;
    }

    public function delete(Booking $booking): bool
    {
        return $this->repository->delete($booking);
    }

    public function generateBookingNo(): string
    {
        do {
            $number = 'MNU-'.strtoupper(Str::random(6));
        } while (Booking::withTrashed()->where('booking_no', $number)->exists());

        return $number;
    }
}
