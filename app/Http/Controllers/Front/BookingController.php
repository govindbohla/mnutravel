<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\BookingRequest;
use App\Mail\BookingReceivedMail;
use App\Services\BookingService;
use App\Services\CustomerLookupService;
use App\Support\Settings;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function __construct(
        protected BookingService $bookingService,
        protected CustomerLookupService $customerLookup,
    ) {
    }

    public function store(BookingRequest $request): JsonResponse
    {
        $data = $request->validated();

        $customer = $this->customerLookup->findOrCreate($data['customer_name'], $data['phone'], $data['email'] ?? null);
        $data['customer_id'] = $customer->id;

        $booking = $this->bookingService->create($data);

        $this->notifyAdmin($booking);

        return response()->json([
            'message' => "Thank you! Your booking has been received. Your booking reference is {$booking->booking_no}. Our team will contact you shortly.",
            'booking_no' => $booking->booking_no,
        ]);
    }

    protected function notifyAdmin($booking): void
    {
        $adminEmail = Settings::get('admin_notification_email');

        if (! $adminEmail) {
            return;
        }

        try {
            Mail::to($adminEmail)->send(new BookingReceivedMail($booking));
        } catch (\Throwable $e) {
            Log::warning('Failed to send booking notification email: '.$e->getMessage());
        }
    }
}
