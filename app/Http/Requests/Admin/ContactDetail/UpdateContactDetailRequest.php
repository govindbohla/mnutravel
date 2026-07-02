<?php

namespace App\Http\Requests\Admin\ContactDetail;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('contact.edit');
    }

    public function rules(): array
    {
        return [
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'alt_phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'map_iframe' => ['nullable', 'string'],
            'business_hours.monday_saturday' => ['nullable', 'string', 'max:100'],
            'business_hours.sunday' => ['nullable', 'string', 'max:100'],
            'business_hours.note' => ['nullable', 'string', 'max:255'],
        ];
    }
}
