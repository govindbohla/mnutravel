<?php

namespace Database\Seeders;

use App\Models\TourPackage;
use Database\Seeders\Concerns\SeedsDemoImages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TourPackageSeeder extends Seeder
{
    use SeedsDemoImages;

    public function run(): void
    {
        $packages = [
            [
                'name' => 'Jaipur Local Tour Package',
                'destination' => 'Jaipur',
                'duration' => 'Full Day (8-9 Hrs)',
                'price' => 2500,
                'description' => 'A full-day guided tour of Jaipur city covering the most popular local attractions, ideal for visitors who want to see the Pink City in a single day.',
                'inclusions' => "AC Vehicle for the Full Day\nProfessional Driver\nFuel & Driver Allowance\nAll Toll & Parking Charges",
                'exclusions' => "Monument Entry Fees\nGuide Charges\nMeals\nPersonal Expenses",
                'image' => null,
            ],
            [
                'name' => 'Jaipur Sightseeing Tour Package',
                'destination' => 'Jaipur',
                'duration' => 'Full Day (10-12 Hrs)',
                'price' => 3000,
                'description' => 'An extended sightseeing tour covering Amber Fort, City Palace, Hawa Mahal, Jantar Mantar, and other major Jaipur landmarks at a relaxed pace.',
                'inclusions' => "AC Vehicle for the Full Day\nProfessional Driver\nFuel & Driver Allowance\nAll Toll & Parking Charges",
                'exclusions' => "Monument Entry Fees\nGuide Charges\nMeals\nPersonal Expenses",
                'image' => null,
            ],
            [
                'name' => 'Ajmer Pushkar Tour Package',
                'destination' => 'Ajmer - Pushkar',
                'duration' => '1 Day',
                'price' => 3500,
                'description' => 'Visit the sacred Ajmer Sharif Dargah and the holy town of Pushkar, known for its lake and temples, on this convenient one-day trip from Jaipur.',
                'inclusions' => "AC Vehicle for the Full Day\nProfessional Driver\nFuel & Driver Allowance\nAll Toll & Parking Charges",
                'exclusions' => "Meals\nOffering/Donation Charges\nPersonal Expenses",
                'image' => null,
            ],
            [
                'name' => 'Khatu Shyam Tour Package',
                'destination' => 'Khatu Shyam',
                'duration' => '1 Day',
                'price' => 3000,
                'description' => 'A comfortable one-day pilgrimage trip to the famous Khatu Shyam Ji temple, a popular destination for devotees across India.',
                'inclusions' => "AC Vehicle for the Full Day\nProfessional Driver\nFuel & Driver Allowance\nAll Toll & Parking Charges",
                'exclusions' => "Meals\nOffering/Donation Charges\nPersonal Expenses",
                'image' => null,
            ],
            [
                'name' => 'Salasar Balaji Tour Package',
                'destination' => 'Salasar Balaji',
                'duration' => '1 Day',
                'price' => 3200,
                'description' => 'A day trip to the revered Salasar Balaji temple, offering a comfortable and hassle-free pilgrimage experience.',
                'inclusions' => "AC Vehicle for the Full Day\nProfessional Driver\nFuel & Driver Allowance\nAll Toll & Parking Charges",
                'exclusions' => "Meals\nOffering/Donation Charges\nPersonal Expenses",
                'image' => null,
            ],
            [
                'name' => 'Delhi Tour Package',
                'destination' => 'Delhi',
                'duration' => '2 Days / 1 Night',
                'price' => 8000,
                'description' => 'Explore India\'s capital city, from historic monuments like Red Fort and Qutub Minar to modern markets and India Gate.',
                'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAC Vehicle for Sightseeing\nAll Toll & Parking Charges",
                'exclusions' => "Monument Entry Fees\nLunch & Dinner\nPersonal Expenses",
                'image' => null,
            ],
            [
                'name' => 'Agra Tour Package',
                'destination' => 'Agra',
                'duration' => '1 Day',
                'price' => 5500,
                'description' => 'A same-day trip to Agra to witness the timeless beauty of the Taj Mahal and Agra Fort, with comfortable AC travel throughout.',
                'inclusions' => "AC Vehicle for the Full Day\nProfessional Driver\nFuel & Driver Allowance\nAll Toll & Parking Charges",
                'exclusions' => "Monument Entry Fees\nMeals\nGuide Charges\nPersonal Expenses",
                'image' => null,
            ],
            [
                'name' => 'Udaipur Tour Package',
                'destination' => 'Udaipur',
                'duration' => '2 Days / 1 Night',
                'price' => 9000,
                'description' => 'Discover the City of Lakes with visits to City Palace, Lake Pichola, and Saheliyon Ki Bari on this comfortable 2-day getaway.',
                'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAC Vehicle for Sightseeing\nAll Toll & Parking Charges",
                'exclusions' => "Monument Entry Fees\nLunch & Dinner\nBoat Ride Charges\nPersonal Expenses",
                'image' => null,
            ],
            [
                'name' => 'Jodhpur Tour Package',
                'destination' => 'Jodhpur',
                'duration' => '2 Days / 1 Night',
                'price' => 8500,
                'description' => 'Visit the Blue City of Jodhpur, home to the majestic Mehrangarh Fort and Umaid Bhawan Palace, on this well-paced 2-day tour.',
                'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAC Vehicle for Sightseeing\nAll Toll & Parking Charges",
                'exclusions' => "Monument Entry Fees\nLunch & Dinner\nPersonal Expenses",
                'image' => null,
            ],
            [
                'name' => 'Mount Abu Tour Package',
                'destination' => 'Mount Abu',
                'duration' => '2 Days / 1 Night',
                'price' => 9500,
                'description' => 'Escape to Rajasthan\'s only hill station, Mount Abu, known for Dilwara Temples, Nakki Lake, and pleasant weather year-round.',
                'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAC Vehicle for Sightseeing\nAll Toll & Parking Charges",
                'exclusions' => "Monument Entry Fees\nLunch & Dinner\nBoating Charges\nPersonal Expenses",
                'image' => null,
            ],
            [
                'name' => 'Ranthambore Tour Package',
                'destination' => 'Ranthambore',
                'duration' => '2 Days / 1 Night',
                'price' => 10000,
                'description' => 'Experience wildlife at its best with a jungle safari in Ranthambore National Park, one of India\'s premier tiger reserves.',
                'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAC Vehicle for Transfers\nAll Toll & Parking Charges",
                'exclusions' => "Safari/Jeep Charges\nNational Park Entry Fees\nLunch & Dinner\nPersonal Expenses",
                'image' => null,
            ],
            [
                'name' => 'Bikaner Tour Package',
                'destination' => 'Bikaner',
                'duration' => '2 Days / 1 Night',
                'price' => 8000,
                'description' => 'Explore the desert city of Bikaner, famous for Junagarh Fort, the Karni Mata Temple, and its distinct culinary traditions.',
                'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAC Vehicle for Sightseeing\nAll Toll & Parking Charges",
                'exclusions' => "Monument Entry Fees\nLunch & Dinner\nPersonal Expenses",
                'image' => null,
            ],

            // Additional long-distance packages, kept from the original catalog.
            [
                'name' => 'Shimla Manali Tour Package',
                'destination' => 'Shimla - Manali',
                'duration' => '5 Days / 4 Nights',
                'price' => 18500,
                'description' => 'Experience the beauty of the Himalayas with our Shimla-Manali tour package, covering scenic valleys, snow-capped peaks, and charming hill towns.',
                'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAC Vehicle for Sightseeing\nAll Toll & Parking Charges",
                'exclusions' => "Airfare\nPersonal Expenses\nLunch & Dinner\nMonument Entry Fees",
                'image' => 'tour-packages/shimla-manali.jpg',
            ],
            [
                'name' => 'Goa Beaches Tour Package',
                'destination' => 'Goa',
                'duration' => '4 Days / 3 Nights',
                'price' => 15000,
                'description' => 'Relax on the golden beaches of Goa with our curated tour package, including beach hopping, water sports, and vibrant nightlife.',
                'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAirport Pickup & Drop\nSightseeing by AC Vehicle",
                'exclusions' => "Airfare\nWater Sports Charges\nPersonal Expenses\nLunch & Dinner",
                'image' => 'tour-packages/goa-beaches.jpg',
            ],
            [
                'name' => 'Kerala Backwaters Tour Package',
                'destination' => 'Kerala',
                'duration' => '6 Days / 5 Nights',
                'price' => 28000,
                'description' => 'Discover the serene backwaters of Kerala with houseboat stays, tea plantations, and lush greenery on this unforgettable tour.',
                'inclusions' => "Hotel & Houseboat Accommodation\nDaily Breakfast & Dinner\nAC Vehicle for Sightseeing\nHouseboat Cruise",
                'exclusions' => "Airfare\nPersonal Expenses\nLunch\nEntry Tickets",
                'image' => 'tour-packages/kerala-backwaters.jpg',
            ],
            [
                'name' => 'Rajasthan Heritage Tour Package',
                'destination' => 'Rajasthan',
                'duration' => '7 Days / 6 Nights',
                'price' => 32000,
                'description' => 'Explore the royal heritage of Rajasthan, visiting majestic forts, palaces, and vibrant local markets across Jaipur, Udaipur, and Jodhpur.',
                'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAC Vehicle for the Entire Trip\nProfessional Driver",
                'exclusions' => "Airfare/Train Fare\nMonument Entry Fees\nPersonal Expenses\nLunch & Dinner",
                'image' => 'tour-packages/rajasthan-heritage.jpg',
            ],
        ];

        foreach ($packages as $package) {
            $slug = Str::slug($package['name']);
            $existing = TourPackage::query()->where('slug', $slug)->first();

            $imagePath = $existing?->featured_image;

            if (! $imagePath && $package['image']) {
                $imagePath = $this->seedImage($package['image'], 'tour-packages');
            }

            $data = $package;
            unset($data['image']);
            $data['featured_image'] = $imagePath;

            TourPackage::query()->updateOrCreate(
                ['slug' => $slug],
                $data + ['status' => 'active']
            );
        }
    }
}
