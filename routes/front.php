<?php

use App\Http\Controllers\Front\BookingController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\EnquiryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\ServiceController;
use App\Http\Controllers\Front\SitemapController;
use App\Http\Controllers\Front\TestimonialController;
use App\Http\Controllers\Front\TourPackageController;
use App\Http\Controllers\Front\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/our-cars', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/our-cars/{vehicle:slug}', [VehicleController::class, 'show'])->name('vehicles.show');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/tour-packages', [TourPackageController::class, 'index'])->name('tour-packages.index');
Route::get('/tour-packages/{tourPackage:slug}', [TourPackageController::class, 'show'])->name('tour-packages.show');

Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');

Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
        'Disallow: /admin',
        'Disallow: /login',
        'Disallow: /register',
        '',
        'Sitemap: '.route('sitemap'),
    ];

    return response(implode("\n", $lines), 200)->header('Content-Type', 'text/plain');
})->name('robots');

// Catch-all for CMS-managed pages (About Us, Privacy Policy, Terms & Conditions,
// and any future page created in the admin) - must stay last.
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');
