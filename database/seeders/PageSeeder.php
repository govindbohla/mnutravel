<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => '<p>MNU Travels is a trusted name in taxi and travel booking services, committed to providing safe, reliable, and comfortable journeys across the country. With a modern fleet of well-maintained vehicles and professionally trained drivers, we make sure every trip you take with us is smooth and stress-free.</p><p>From airport transfers and local taxis to outstation trips and curated tour packages, our goal is to be your trusted travel partner for every journey, big or small.</p>',
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<p>MNU Travels values your privacy. This policy explains how we collect, use, and protect the personal information you share with us when booking a taxi, tour package, or contacting our support team.</p><p>We only collect the information necessary to process your bookings and enquiries, such as your name, phone number, and email address. We do not sell or share your personal data with third parties except as required to fulfil your booking.</p>',
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-and-conditions',
                'content' => '<p>By using the MNU Travels website and booking services, you agree to the following terms and conditions. All bookings are subject to vehicle availability. Journey dates, times, and vehicle types may be adjusted based on availability, with prior communication to the customer.</p><p>Cancellations and changes to bookings should be communicated as early as possible. MNU Travels reserves the right to modify these terms at any time.</p>',
            ],
        ];

        foreach ($pages as $page) {
            Page::query()->updateOrCreate(['slug' => $page['slug']], $page + ['status' => 'active']);
        }
    }
}
