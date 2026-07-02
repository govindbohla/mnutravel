<?php

namespace Database\Factories;

use App\Models\VehicleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<VehicleCategory>
 */
class VehicleCategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement(['Sedan', 'SUV', 'Luxury', 'Tempo Traveller', 'Hatchback', 'MUV']);

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.$this->faker->unique()->numberBetween(1, 9999),
            'image' => null,
            'status' => 'active',
        ];
    }
}
