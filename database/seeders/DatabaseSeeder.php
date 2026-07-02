<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            AdminUserSeeder::class,
            SettingsSeeder::class,
            ContactDetailSeeder::class,
            PageSeeder::class,
            MenuSeeder::class,
            VehicleCategorySeeder::class,
            VehicleSeeder::class,
            ServiceSeeder::class,
            TourPackageSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            HeroSliderSeeder::class,
        ]);
    }
}
