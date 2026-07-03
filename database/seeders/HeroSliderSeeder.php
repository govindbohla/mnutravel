<?php

namespace Database\Seeders;

use App\Models\HeroSlider;
use Database\Seeders\Concerns\SeedsDemoImages;
use Illuminate\Database\Seeder;

class HeroSliderSeeder extends Seeder
{
    use SeedsDemoImages;

    public function run(): void
    {
        $slides = [
            [
                'title' => 'Your Trusted Travel Partner',
                'subtitle' => 'Safe, reliable, and comfortable taxi services across Rajasthan and beyond',
                'source' => 'sliders/slider1.jpg',
                'fallback' => 'https://placehold.co/1920x600?text=MNU+Travels',
                'button_text' => 'Book Now',
                'button_link' => '#booking-modal',
            ],
            [
                'title' => 'Explore Rajasthan With Us',
                'subtitle' => 'Curated tour packages to Jaipur, Udaipur, Jodhpur, and beyond',
                'source' => null,
                'fallback' => 'https://placehold.co/1920x600?text=Explore+Rajasthan',
                'button_text' => 'View Packages',
                'button_link' => '/tour-packages',
            ],
            [
                'title' => 'Pilgrimage Trips Made Easy',
                'subtitle' => 'Comfortable one-day trips to Khatu Shyam, Salasar Balaji, and Ajmer-Pushkar',
                'source' => null,
                'fallback' => 'https://placehold.co/1920x600?text=Pilgrimage+Tours',
                'button_text' => 'Enquire Now',
                'button_link' => '#enquiry-modal',
            ],
            [
                'title' => 'Airport & Railway Transfers',
                'subtitle' => 'On-time pickup and drop with live flight and train tracking',
                'source' => null,
                'fallback' => 'https://placehold.co/1920x600?text=Airport+Transfers',
                'button_text' => 'Our Services',
                'button_link' => '/services',
            ],
            [
                'title' => 'Fleet for Every Occasion',
                'subtitle' => 'Sedans, SUVs, luxury cars, and tempo travellers for every group size',
                'source' => null,
                'fallback' => 'https://placehold.co/1920x600?text=Our+Fleet',
                'button_text' => 'View Our Cars',
                'button_link' => '/our-cars',
            ],
        ];

        foreach ($slides as $index => $slide) {
            $existing = HeroSlider::query()->where('title', $slide['title'])->first();

            $imagePath = $existing?->image;

            if (! $imagePath) {
                $imagePath = ($slide['source'] ? $this->seedImage($slide['source'], 'hero-sliders') : null)
                    ?? $slide['fallback'];
            }

            HeroSlider::query()->updateOrCreate(
                ['title' => $slide['title']],
                [
                    'subtitle' => $slide['subtitle'],
                    'image' => $imagePath,
                    'button_text' => $slide['button_text'],
                    'button_link' => $slide['button_link'],
                    'sort_order' => $index,
                    'status' => 'active',
                ]
            );
        }
    }
}
