<?php

namespace App\Providers;

use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\Contracts\EnquiryRepositoryInterface;
use App\Repositories\Eloquent\BookingRepository;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Eloquent\EnquiryRepository;
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
    ];

    public function register(): void
    {
        foreach ($this->repositoryBindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
