<?php

namespace Database\Seeders;

use App\Models\ContactDetail;
use Illuminate\Database\Seeder;

class ContactDetailSeeder extends Seeder
{
    public function run(): void
    {
        ContactDetail::query()->updateOrCreate(['id' => 1], [
            'address' => '221, MI Road, Near Ajmeri Gate, Jaipur, Rajasthan - 302001',
            'phone' => '+91 98281 23456',
            'alt_phone' => '+91 98280 98765',
            'email' => 'info@mnutravels.com',
            'map_iframe' => '<iframe src="https://www.google.com/maps?q=26.9124,75.7873&output=embed" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'business_hours' => [
                'monday_saturday' => '24 Hours',
                'sunday' => '24 Hours',
                'note' => 'Available round the clock for bookings and support',
            ],
        ]);
    }
}
