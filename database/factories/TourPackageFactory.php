<?php

namespace Database\Factories;

use App\Models\TourPackage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<TourPackage>
 */
class TourPackageFactory extends Factory
{
    public function definition(): array
    {
        $destination = $this->faker->unique()->randomElement([
            'Shimla - Manali', 'Goa Beaches', 'Kerala Backwaters', 'Rajasthan Heritage',
            'Golden Triangle', 'Kashmir Valley', 'Andaman Islands', 'Ooty - Munnar',
        ]);

        $name = $destination.' Tour Package';
        $days = $this->faker->numberBetween(2, 7);

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.$this->faker->unique()->numberBetween(1, 9999),
            'destination' => $destination,
            'duration' => "{$days} Days / ".($days - 1).' Nights',
            'price' => $this->faker->randomFloat(2, 8000, 45000),
            'featured_image' => null,
            'description' => $this->faker->paragraphs(3, true),
            'inclusions' => "Hotel Accommodation\nDaily Breakfast\nAC Vehicle for Sightseeing\nAirport/Railway Pickup & Drop",
            'exclusions' => "Airfare/Train Fare\nPersonal Expenses\nLunch & Dinner\nEntry Tickets",
            'status' => 'active',
        ];
    }
}
