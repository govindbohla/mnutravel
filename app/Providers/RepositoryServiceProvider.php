<?php

namespace App\Providers;

use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\Contracts\EnquiryRepositoryInterface;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Repositories\Contracts\TourPackageRepositoryInterface;
use App\Repositories\Contracts\VehicleCategoryRepositoryInterface;
use App\Repositories\Contracts\VehicleRepositoryInterface;
use App\Repositories\Eloquent\BookingRepository;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Eloquent\EnquiryRepository;
use App\Repositories\Eloquent\ServiceRepository;
use App\Repositories\Eloquent\TourPackageRepository;
use App\Repositories\Eloquent\VehicleCategoryRepository;
use App\Repositories\Eloquent\VehicleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Maps each repository interface to its Eloquent implementation.
     */
    protected array $repositoryBindings = [
        BookingRepositoryInterface::class => BookingRepository::class,
        EnquiryRepositoryInterface::class => EnquiryRepository::class,
        CustomerRepositoryInterface::class => CustomerRepository::class,
        VehicleCategoryRepositoryInterface::class => VehicleCategoryRepository::class,
        VehicleRepositoryInterface::class => VehicleRepository::class,
        ServiceRepositoryInterface::class => ServiceRepository::class,
        TourPackageRepositoryInterface::class => TourPackageRepository::class,
    ];

    public function register(): void
    {
        foreach ($this->repositoryBindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
