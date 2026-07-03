<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Enquiry;
use Illuminate\Database\Seeder;

class EnquirySeeder extends Seeder
{
    protected const TOTAL = 100;

    public function run(): void
    {
        $existing = Enquiry::count();

        if ($existing >= self::TOTAL) {
            return;
        }

        $customers = Customer::all();

        if ($customers->isEmpty()) {
            return;
        }

        for ($i = 0; $i < self::TOTAL - $existing; $i++) {
            // Roughly 70% of enquiries come from an already-known customer,
            // the rest are first-time contacts not yet linked to a record -
            // matches how the public enquiry form behaves in practice.
            $customer = $this->randomFloat() < 0.7 ? $customers->random() : null;

            Enquiry::factory()->create($customer ? [
                'customer_id' => $customer->id,
                'name' => $customer->name,
                'phone' => $customer->phone,
                'email' => $customer->email,
            ] : []);
        }
    }

    protected function randomFloat(): float
    {
        return mt_rand() / mt_getrandmax();
    }
}
