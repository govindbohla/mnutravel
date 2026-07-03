<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    protected const TOTAL = 200;

    public function run(): void
    {
        $existing = Booking::count();

        if ($existing >= self::TOTAL) {
            return;
        }

        $customers = Customer::all();
        $vehicles = Vehicle::all();

        if ($customers->isEmpty() || $vehicles->isEmpty()) {
            return;
        }

        for ($i = 0; $i < self::TOTAL - $existing; $i++) {
            $customer = $customers->random();
            $vehicle = $vehicles->random();

            Booking::factory()->create([
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'vehicle_id' => $vehicle->id,
            ]);
        }
    }
}
