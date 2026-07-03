<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    protected const TOTAL = 100;

    public function run(): void
    {
        $existing = Customer::count();

        if ($existing >= self::TOTAL) {
            return;
        }

        Customer::factory()->count(self::TOTAL - $existing)->create();
    }
}
