<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Database\Seeders\Concerns\SeedsDemoImages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    use SeedsDemoImages;

    public function run(): void
    {
        $vehicles = [
            ['category' => 'Sedan', 'name' => 'Toyota Etios', 'passenger_capacity' => 4, 'luggage_capacity' => 2, 'price' => 1800, 'is_ac' => true, 'image' => 'vehicles/toyota-etios.jpg'],
            ['category' => 'Sedan', 'name' => 'Maruti Suzuki Dzire', 'passenger_capacity' => 4, 'luggage_capacity' => 2, 'price' => 1700, 'is_ac' => true, 'image' => 'vehicles/maruti-suzuki-dzire.jpg'],
            ['category' => 'Sedan', 'name' => 'Honda Amaze', 'passenger_capacity' => 4, 'luggage_capacity' => 2, 'price' => 1750, 'is_ac' => true, 'image' => null],
            ['category' => 'Sedan', 'name' => 'Hyundai Aura', 'passenger_capacity' => 4, 'luggage_capacity' => 2, 'price' => 1650, 'is_ac' => false, 'image' => null],
            ['category' => 'SUV', 'name' => 'Toyota Innova Crysta', 'passenger_capacity' => 7, 'luggage_capacity' => 3, 'price' => 3200, 'is_ac' => true, 'image' => 'vehicles/toyota-innova-crysta.jpg'],
            ['category' => 'SUV', 'name' => 'Mahindra XUV700', 'passenger_capacity' => 6, 'luggage_capacity' => 3, 'price' => 3500, 'is_ac' => true, 'image' => 'vehicles/mahindra-xuv700.jpg'],
            ['category' => 'SUV', 'name' => 'Hyundai Creta', 'passenger_capacity' => 5, 'luggage_capacity' => 3, 'price' => 2800, 'is_ac' => true, 'image' => null],
            ['category' => 'SUV', 'name' => 'Kia Seltos', 'passenger_capacity' => 5, 'luggage_capacity' => 3, 'price' => 2900, 'is_ac' => true, 'image' => null],
            ['category' => 'Luxury', 'name' => 'Toyota Fortuner', 'passenger_capacity' => 6, 'luggage_capacity' => 3, 'price' => 5500, 'is_ac' => true, 'image' => 'vehicles/toyota-fortuner.jpg'],
            ['category' => 'Luxury', 'name' => 'Mercedes-Benz E-Class', 'passenger_capacity' => 4, 'luggage_capacity' => 2, 'price' => 9000, 'is_ac' => true, 'image' => 'vehicles/mercedes-benz-e-class.jpg'],
            ['category' => 'Luxury', 'name' => 'BMW 5 Series', 'passenger_capacity' => 4, 'luggage_capacity' => 2, 'price' => 9500, 'is_ac' => true, 'image' => null],
            ['category' => 'Luxury', 'name' => 'Audi A6', 'passenger_capacity' => 4, 'luggage_capacity' => 2, 'price' => 9800, 'is_ac' => true, 'image' => null],
            ['category' => 'Tempo Traveller', 'name' => 'Force Tempo Traveller 12-Seater', 'passenger_capacity' => 12, 'luggage_capacity' => 6, 'price' => 4500, 'is_ac' => true, 'image' => 'vehicles/force-tempo-traveller-12-seater.jpg'],
            ['category' => 'Tempo Traveller', 'name' => 'Force Tempo Traveller 17-Seater', 'passenger_capacity' => 17, 'luggage_capacity' => 8, 'price' => 6000, 'is_ac' => true, 'image' => 'vehicles/force-tempo-traveller-17-seater.jpg'],
            ['category' => 'Tempo Traveller', 'name' => 'Force Urbania', 'passenger_capacity' => 15, 'luggage_capacity' => 7, 'price' => 5800, 'is_ac' => true, 'image' => null],
        ];

        foreach ($vehicles as $vehicle) {
            $category = VehicleCategory::query()->where('name', $vehicle['category'])->first();

            if (! $category) {
                continue;
            }

            $existing = Vehicle::query()->where('slug', Str::slug($vehicle['name']))->first();

            $imagePath = $existing?->image;

            if (! $imagePath && $vehicle['image']) {
                $imagePath = $this->seedImage($vehicle['image'], 'vehicles');
            }

            Vehicle::query()->updateOrCreate(
                ['slug' => Str::slug($vehicle['name'])],
                [
                    'vehicle_category_id' => $category->id,
                    'name' => $vehicle['name'],
                    'image' => $imagePath,
                    'passenger_capacity' => $vehicle['passenger_capacity'],
                    'luggage_capacity' => $vehicle['luggage_capacity'],
                    'is_ac' => $vehicle['is_ac'],
                    'description' => "Comfortable and well-maintained {$vehicle['name']}, perfect for city rides and outstation trips with professional drivers.",
                    'price' => $vehicle['price'],
                    'status' => 'active',
                ]
            );
        }
    }
}
