<?php

namespace Database\Seeders;

use App\Models\TourPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TourPackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Shimla Manali Tour Package',
                'destination' => 'Shimla - Manali',
                'duration' => '5 Days / 4 Nights',
                'price' => 18500,
                'description' => 'Experience the beauty of the Himalayas with our Shimla-Manali tour package, covering scenic valleys, snow-capped peaks, and charming hill towns.',
                'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAC Vehicle for Sightseeing\nAll Toll & Parking Charges",
                'exclusions' => "Airfare\nPersonal Expenses\nLunch & Dinner\nMonument Entry Fees",
            ],
            [
                'name' => 'Goa Beaches Tour Package',
                'destination' => 'Goa',
                'duration' => '4 Days / 3 Nights',
                'price' => 15000,
                'description' => 'Relax on the golden beaches of Goa with our curated tour package, including beach hopping, water sports, and vibrant nightlife.',
                'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAirport Pickup & Drop\nSightseeing by AC Vehicle",
                'exclusions' => "Airfare\nWater Sports Charges\nPersonal Expenses\nLunch & Dinner",
            ],
            [
                'name' => 'Kerala Backwaters Tour Package',
                'destination' => 'Kerala',
                'duration' => '6 Days / 5 Nights',
                'price' => 28000,
                'description' => 'Discover the serene backwaters of Kerala with houseboat stays, tea plantations, and lush greenery on this unforgettable tour.',
                'inclusions' => "Hotel & Houseboat Accommodation\nDaily Breakfast & Dinner\nAC Vehicle for Sightseeing\nHouseboat Cruise",
                'exclusions' => "Airfare\nPersonal Expenses\nLunch\nEntry Tickets",
            ],
            [
                'name' => 'Rajasthan Heritage Tour Package',
                'destination' => 'Rajasthan',
                'duration' => '7 Days / 6 Nights',
                'price' => 32000,
                'description' => 'Explore the royal heritage of Rajasthan, visiting majestic forts, palaces, and vibrant local markets across Jaipur, Udaipur, and Jodhpur.',
                'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAC Vehicle for the Entire Trip\nProfessional Driver",
                'exclusions' => "Airfare/Train Fare\nMonument Entry Fees\nPersonal Expenses\nLunch & Dinner",
            ],
        ];

        foreach ($packages as $package) {
            TourPackage::query()->updateOrCreate(
                ['slug' => Str::slug($package['name'])],
                $package + ['status' => 'active']
            );
        }
    }
}
