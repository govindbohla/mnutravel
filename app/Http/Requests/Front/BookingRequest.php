<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'trip_type' => ['required', Rule::in(['one_way', 'round_trip'])],
            'pickup_location' => ['required', 'string', 'max:255'],
            'drop_location' => ['required', 'string', 'max:255'],
            'journey_date' => ['required', 'date', 'after_or_equal:today'],
            'journey_time' => ['required'],
            'return_date' => ['nullable', 'date', 'after_or_equal:journey_date'],
            'vehicle_id' => ['nullable', 'exists:vehicles,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
