<?php

namespace Database\Seeders;

use App\Models\Service;
use Database\Seeders\Concerns\SeedsDemoImages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    use SeedsDemoImages;

    public function run(): void
    {
        // Renamed from "Wedding Taxi" - remap the old slug in place so a
        // second seeder run doesn't leave an orphaned duplicate behind.
        $renamed = Service::query()->where('slug', 'wedding-taxi')->first();
        $renamed?->update(['name' => 'Wedding Car Rental', 'slug' => 'wedding-car-rental']);

        $services = [
            [
                'name' => 'Airport Transfer',
                'icon' => 'fa-solid fa-plane',
                'short_description' => 'On-time airport pickup and drop with flight tracking.',
                'description' => 'Our airport transfer service ensures you reach the airport on time or get picked up promptly after landing, with real-time flight tracking and professional drivers.',
                'image' => 'services/airport-transfer.png',
            ],
            [
                'name' => 'Local Taxi',
                'icon' => 'fa-solid fa-city',
                'short_description' => 'Hourly and daily local taxi rentals within the city.',
                'description' => 'Book a local taxi for city rides, shopping trips, or business meetings with flexible hourly and daily rental packages.',
                'image' => null,
            ],
            [
                'name' => 'Outstation Taxi',
                'icon' => 'fa-solid fa-route',
                'short_description' => 'Comfortable one-way and round-trip outstation cabs.',
                'description' => 'Travel between cities comfortably with our outstation taxi service, offering well-maintained vehicles for both one-way and round-trip journeys.',
                'image' => 'services/outstation-taxi.jpg',
            ],
            [
                'name' => 'Corporate Taxi',
                'icon' => 'fa-solid fa-briefcase',
                'short_description' => 'Reliable transport solutions for businesses and employees.',
                'description' => 'Our corporate taxi service offers reliable, professional transportation for businesses, including employee commutes and client transfers.',
                'image' => 'services/corporate-taxi.jpg',
            ],
            [
                'name' => 'Wedding Car Rental',
                'icon' => 'fa-solid fa-heart',
                'short_description' => 'Decorated cars and fleets for your special day.',
                'description' => 'Make your wedding day special with our fleet of well-maintained and decorated cars, along with professional chauffeurs.',
                'image' => 'services/wedding-car-rental.jpg',
            ],
            [
                'name' => 'Railway Pickup',
                'icon' => 'fa-solid fa-train',
                'short_description' => 'Timely railway station pickup and drop services.',
                'description' => 'Get picked up or dropped off at the railway station on time with our dedicated railway pickup and drop service.',
                'image' => 'services/railway-pickup.jpg',
            ],
        ];

        foreach ($services as $index => $service) {
            $slug = Str::slug($service['name']);
            $existing = Service::query()->where('slug', $slug)->first();

            $imagePath = $existing?->image;

            if (! $imagePath && $service['image']) {
                $imagePath = $this->seedImage($service['image'], 'services');
            }

            $data = $service;
            unset($data['image']);
            $data['image'] = $imagePath;

            Service::query()->updateOrCreate(
                ['slug' => $slug],
                $data + ['sort_order' => $index, 'status' => 'active']
            );
        }
    }
}
