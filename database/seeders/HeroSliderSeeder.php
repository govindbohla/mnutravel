<?php

namespace Database\Seeders;

use App\Models\HeroSlider;
use Illuminate\Database\Seeder;

class HeroSliderSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Your Trusted Travel Partner',
                'subtitle' => 'Safe, reliable, and comfortable taxi services across India',
                'image' => 'assets/img/logo.png',
                'button_text' => 'Book Now',
                'button_link' => '#booking-modal',
            ],
            [
                'title' => 'Explore India With Us',
                'subtitle' => 'Curated tour packages for unforgettable journeys',
                'image' => 'assets/img/logo.png',
                'button_text' => 'View Packages',
                'button_link' => '/tour-packages',
            ],
        ];

        foreach ($slides as $index => $slide) {
            HeroSlider::query()->firstOrCreate(
                ['title' => $slide['title']],
                $slide + ['sort_order' => $index, 'status' => 'active']
            );
        }
    }
}
