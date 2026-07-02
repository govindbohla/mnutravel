<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            ['category' => 'Sedan', 'name' => 'Toyota Etios', 'passenger_capacity' => 4, 'luggage_capacity' => 2, 'price' => 1800],
            ['category' => 'Sedan', 'name' => 'Maruti Suzuki Dzire', 'passenger_capacity' => 4, 'luggage_capacity' => 2, 'price' => 1700],
            ['category' => 'SUV', 'name' => 'Toyota Innova Crysta', 'passenger_capacity' => 7, 'luggage_capacity' => 3, 'price' => 3200],
            ['category' => 'SUV', 'name' => 'Mahindra XUV700', 'passenger_capacity' => 6, 'luggage_capacity' => 3, 'price' => 3500],
            ['category' => 'Luxury', 'name' => 'Toyota Fortuner', 'passenger_capacity' => 6, 'luggage_capacity' => 3, 'price' => 5500],
            ['category' => 'Luxury', 'name' => 'Mercedes-Benz E-Class', 'passenger_capacity' => 4, 'luggage_capacity' => 2, 'price' => 9000],
            ['category' => 'Tempo Traveller', 'name' => 'Force Tempo Traveller 12-Seater', 'passenger_capacity' => 12, 'luggage_capacity' => 6, 'price' => 4500],
            ['category' => 'Tempo Traveller', 'name' => 'Force Tempo Traveller 17-Seater', 'passenger_capacity' => 17, 'luggage_capacity' => 8, 'price' => 6000],
        ];

        foreach ($vehicles as $vehicle) {
            $category = VehicleCategory::query()->where('name', $vehicle['category'])->first();

            if (! $category) {
                continue;
            }

            Vehicle::query()->updateOrCreate(
                ['slug' => Str::slug($vehicle['name'])],
                [
                    'vehicle_category_id' => $category->id,
                    'name' => $vehicle['name'],
                    'passenger_capacity' => $vehicle['passenger_capacity'],
                    'luggage_capacity' => $vehicle['luggage_capacity'],
                    'is_ac' => true,
                    'description' => "Comfortable and well-maintained {$vehicle['name']}, perfect for city rides and outstation trips with professional drivers.",
                    'price' => $vehicle['price'],
                    'status' => 'active',
                ]
            );
        }
    }
}
