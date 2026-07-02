<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Toyota Etios', 'Maruti Dzire', 'Toyota Innova Crysta', 'Mahindra XUV700',
            'Toyota Fortuner', 'Mercedes E-Class', 'Force Tempo Traveller 12-Seater',
        ]).' '.$this->faker->numberBetween(1, 999);

        return [
            'vehicle_category_id' => VehicleCategory::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => null,
            'passenger_capacity' => $this->faker->randomElement([4, 6, 7, 12]),
            'luggage_capacity' => $this->faker->numberBetween(1, 4),
            'is_ac' => true,
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 1500, 8000),
            'status' => 'active',
        ];
    }
}
