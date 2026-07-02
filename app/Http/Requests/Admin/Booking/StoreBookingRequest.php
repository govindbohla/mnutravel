<?php

namespace App\Http\Requests\Admin\Booking;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('bookings.create');
    }

    public function rules(): array
    {
        return [
            'trip_type' => ['required', Rule::in(['one_way', 'round_trip'])],
            'pickup_location' => ['required', 'string', 'max:255'],
            'drop_location' => ['required', 'string', 'max:255'],
            'journey_date' => ['required', 'date'],
            'journey_time' => ['required'],
            'return_date' => ['nullable', 'date', 'after_or_equal:journey_date'],
            'vehicle_id' => ['nullable', 'exists:vehicles,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'message' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['new', 'pending', 'confirmed', 'completed', 'cancelled'])],
        ];
    }
}
