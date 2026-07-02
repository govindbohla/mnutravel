<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Airport Transfer',
                'icon' => 'fa-solid fa-plane',
                'short_description' => 'On-time airport pickup and drop with flight tracking.',
                'description' => 'Our airport transfer service ensures you reach the airport on time or get picked up promptly after landing, with real-time flight tracking and professional drivers.',
            ],
            [
                'name' => 'Outstation Taxi',
                'icon' => 'fa-solid fa-route',
                'short_description' => 'Comfortable one-way and round-trip outstation cabs.',
                'description' => 'Travel between cities comfortably with our outstation taxi service, offering well-maintained vehicles for both one-way and round-trip journeys.',
            ],
            [
                'name' => 'Local Taxi',
                'icon' => 'fa-solid fa-city',
                'short_description' => 'Hourly and daily local taxi rentals within the city.',
                'description' => 'Book a local taxi for city rides, shopping trips, or business meetings with flexible hourly and daily rental packages.',
            ],
            [
                'name' => 'Corporate Taxi',
                'icon' => 'fa-solid fa-briefcase',
                'short_description' => 'Reliable transport solutions for businesses and employees.',
                'description' => 'Our corporate taxi service offers reliable, professional transportation for businesses, including employee commutes and client transfers.',
            ],
            [
                'name' => 'Wedding Taxi',
                'icon' => 'fa-solid fa-heart',
                'short_description' => 'Decorated cars and fleets for your special day.',
                'description' => 'Make your wedding day special with our fleet of well-maintained and decorated cars, along with professional chauffeurs.',
            ],
            [
                'name' => 'Railway Pickup',
                'icon' => 'fa-solid fa-train',
                'short_description' => 'Timely railway station pickup and drop services.',
                'description' => 'Get picked up or dropped off at the railway station on time with our dedicated railway pickup and drop service.',
            ],
        ];

        foreach ($services as $index => $service) {
            Service::query()->updateOrCreate(
                ['slug' => Str::slug($service['name'])],
                $service + ['sort_order' => $index, 'status' => 'active']
            );
        }
    }
}
