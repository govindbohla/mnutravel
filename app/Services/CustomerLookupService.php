<?php

namespace App\Services;

use App\Models\Customer;

class CustomerLookupService
{
    public function findOrCreate(string $name, string $phone, ?string $email): Customer
    {
        return Customer::query()->firstOrCreate(
            ['phone' => $phone],
            ['name' => $name, 'email' => $email, 'status' => 'active']
        );
    }
}
