<?php

namespace App\Http\Requests\Admin\HeroSlider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHeroSliderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('hero-sliders.edit');
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'max:4096'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_link' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ];
    }
}
