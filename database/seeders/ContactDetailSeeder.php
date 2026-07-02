<?php

namespace Database\Seeders;

use App\Models\ContactDetail;
use Illuminate\Database\Seeder;

class ContactDetailSeeder extends Seeder
{
    public function run(): void
    {
        ContactDetail::query()->updateOrCreate(['id' => 1], [
            'address' => '123 Travel Street, Business District, New Delhi, India - 110001',
            'phone' => '+91XXXXXXXXXX',
            'alt_phone' => '+91XXXXXXXXXX',
            'email' => 'info@mnutravels.com',
            'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.674!2d77.2090!3d28.6139" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'business_hours' => [
                'monday_saturday' => '24 Hours',
                'sunday' => '24 Hours',
                'note' => 'Available round the clock for bookings and support',
            ],
        ]);
    }
}
