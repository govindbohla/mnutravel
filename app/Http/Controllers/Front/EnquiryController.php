<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\EnquiryRequest;
use App\Mail\EnquiryReceivedMail;
use App\Services\CustomerLookupService;
use App\Services\EnquiryService;
use App\Support\Settings;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    public function __construct(
        protected EnquiryService $enquiryService,
        protected CustomerLookupService $customerLookup,
    ) {
    }

    public function store(EnquiryRequest $request): JsonResponse
    {
        $data = $request->validated();

        $customer = $this->customerLookup->findOrCreate($data['name'], $data['phone'], $data['email'] ?? null);
        $data['customer_id'] = $customer->id;

        $enquiry = $this->enquiryService->create($data);

        $this->notifyAdmin($enquiry);

        return response()->json([
            'message' => 'Thank you for reaching out! Our team will get back to you shortly.',
        ]);
    }

    protected function notifyAdmin($enquiry): void
    {
        $adminEmail = Settings::get('admin_notification_email');

        if (! $adminEmail) {
            return;
        }

        try {
            Mail::to($adminEmail)->send(new EnquiryReceivedMail($enquiry));
        } catch (\Throwable $e) {
            Log::warning('Failed to send enquiry notification email: '.$e->getMessage());
        }
    }
}
