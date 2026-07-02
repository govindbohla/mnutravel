<?php

namespace Database\Seeders;

use App\Support\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'site_name' => 'MNU Travels',
            'site_tagline' => 'Your Trusted Taxi & Travel Partner',
            'site_logo_url' => asset('assets/img/logo.png'),
            'site_favicon_url' => asset('assets/img/logo.png'),
            'whatsapp_number' => env('WHATSAPP_NUMBER', '+91XXXXXXXXXX'),
            'admin_notification_email' => env('ADMIN_NOTIFICATION_EMAIL', 'admin@mnutravels.com'),
            'primary_phone' => '+91XXXXXXXXXX',
            'facebook_url' => '',
            'instagram_url' => '',
            'twitter_url' => '',
            'youtube_url' => '',
            'footer_about' => 'MNU Travels offers reliable taxi, outstation, and tour package services with a modern fleet and professional drivers.',
            'footer_copyright' => '&copy; '.date('Y').' MNU Travels. All rights reserved.',
            'meta_title' => 'MNU Travels - Taxi & Travel Booking',
            'meta_description' => 'Book taxis, outstation cabs, and tour packages with MNU Travels. Safe, reliable, and affordable travel across India.',
            'meta_keywords' => 'taxi booking, cab service, outstation taxi, tour packages, MNU Travels',
        ];

        foreach ($defaults as $key => $value) {
            Settings::set($key, $value);
        }
    }
}
