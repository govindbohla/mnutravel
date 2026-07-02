<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactDetail;
use App\Models\Faq;
use App\Models\HeroSlider;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\TourPackage;
use App\Models\Vehicle;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('front.home', [
            'heroSliders' => HeroSlider::active()->ordered()->get(),
            'vehicles' => Vehicle::active()->with('category')->latest()->take(6)->get(),
            'services' => Service::active()->ordered()->take(6)->get(),
            'packages' => TourPackage::active()->latest()->take(3)->get(),
            'testimonials' => Testimonial::active()->latest()->take(6)->get(),
            'faqs' => Faq::active()->ordered()->get(),
            'contactDetail' => ContactDetail::first(),
        ]);
    }
}
