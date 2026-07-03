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
            'site_tagline' => 'Safe Journey, Happy Journey',
            'site_logo_url' => asset('assets/img/logo.png'),
            'site_favicon_url' => asset('assets/img/logo.png'),
            'whatsapp_number' => env('WHATSAPP_NUMBER', '+919828123456'),
            'admin_notification_email' => env('ADMIN_NOTIFICATION_EMAIL', 'admin@mnutravels.com'),
            'primary_phone' => '+91 98281 23456',
            'facebook_url' => 'https://facebook.com/mnutravels',
            'instagram_url' => 'https://instagram.com/mnutravels',
            'twitter_url' => 'https://twitter.com/mnutravels',
            'youtube_url' => 'https://youtube.com/@mnutravels',
            'footer_about' => 'MNU Travels offers reliable taxi, outstation, and pilgrimage tour services across Rajasthan and beyond, with a modern fleet and professional drivers.',
            'footer_copyright' => '&copy; '.date('Y').' MNU Travels. All rights reserved.',
            'meta_title' => 'MNU Travels - Taxi & Tour Booking in Jaipur, Rajasthan',
            'meta_description' => 'Book taxis, outstation cabs, and Rajasthan tour packages with MNU Travels. Safe, reliable, and affordable travel from Jaipur and across India.',
            'meta_keywords' => 'taxi booking jaipur, cab service rajasthan, outstation taxi, khatu shyam taxi, pushkar taxi, tour packages, MNU Travels',
        ];

        foreach ($defaults as $key => $value) {
            Settings::set($key, $value);
        }
    }
}
