<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        return view('front.testimonials.index', [
            'testimonials' => Testimonial::active()
                ->orderByDesc('rating')
                ->orderByDesc('created_at')
                ->take(9)
                ->get(),
        ]);
    }
}
