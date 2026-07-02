<?php

namespace App\Http\Requests\Admin\Enquiry;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('enquiries.edit');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'message' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['new', 'contacted', 'interested', 'follow_up', 'converted', 'closed'])],
        ];
    }
}
