<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\ServiceController;
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
});
