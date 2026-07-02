<?php

namespace Database\Seeders;

use App\Models\VehicleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VehicleCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Sedan', 'SUV', 'Luxury', 'Tempo Traveller'] as $name) {
            VehicleCategory::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'status' => 'active']
            );
        }
    }
}
