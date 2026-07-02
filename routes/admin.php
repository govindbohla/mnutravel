<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactDetailController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TourPackageController;
use App\Http\Controllers\Admin\VehicleCategoryController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('bookings', BookingController::class)->except(['show']);
    Route::resource('enquiries', EnquiryController::class)->except(['show']);
    Route::resource('customers', CustomerController::class)->except(['show']);

    Route::resource('vehicle-categories', VehicleCategoryController::class)->except(['show']);

    Route::resource('vehicles', VehicleController::class)->except(['show']);
    Route::delete('vehicles/{vehicle}/gallery/{image}', [VehicleController::class, 'destroyGalleryImage'])->name('vehicles.gallery.destroy');

    Route::resource('services', ServiceController::class)->except(['show']);

    Route::resource('tour-packages', TourPackageController::class)->except(['show']);
    Route::delete('tour-packages/{tourPackage}/gallery/{image}', [TourPackageController::class, 'destroyGalleryImage'])->name('tour-packages.gallery.destroy');

    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::resource('faqs', FaqController::class)->except(['show']);
    Route::resource('gallery', GalleryController::class)->except(['show']);
    Route::resource('hero-sliders', HeroSliderController::class)->except(['show']);
    Route::resource('pages', PageController::class)->except(['show']);

    Route::resource('menus', MenuController::class)->except(['show']);
    Route::resource('footer', FooterController::class)->except(['show']);

    Route::get('seo', [SeoController::class, 'index'])->name('seo.index');
    Route::get('seo/{type}/{id}/edit', [SeoController::class, 'edit'])->name('seo.edit');
    Route::put('seo/{type}/{id}', [SeoController::class, 'update'])->name('seo.update');

    Route::get('contact-details', [ContactDetailController::class, 'edit'])->name('contact-details.edit');
    Route::put('contact-details', [ContactDetailController::class, 'update'])->name('contact-details.update');

    Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
});
