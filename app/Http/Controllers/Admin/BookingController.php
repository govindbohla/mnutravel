<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Booking\StoreBookingRequest;
use App\Http\Requests\Admin\Booking\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Services\BookingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class BookingController extends Controller implements HasMiddleware
{
    use HasModulePermissions;

    public function __construct(protected BookingService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'bookings';
    }

    public function index(Request $request): View
    {
        $bookings = $this->service->paginate($request->only(['status', 'trip_type', 'search']));

        return view('admin.bookings.index', [
            'bookings' => $bookings,
            'filters' => $request->only(['status', 'trip_type', 'search']),
        ]);
    }

    public function create(): View
    {
        return view('admin.bookings.create', [
            'vehicles' => Vehicle::active()->orderBy('name')->get(),
        ]);
    }

    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking): View
    {
        return view('admin.bookings.edit', [
            'booking' => $booking,
            'vehicles' => Vehicle::active()->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateBookingRequest $request, Booking $booking): RedirectResponse
    {
        $this->service->update($booking, $request->validated());

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $this->service->delete($booking);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
