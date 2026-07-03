<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // Access control
            RolePermissionSeeder::class,
            AdminUserSeeder::class,
            DemoUserSeeder::class,

            // Site-wide configuration
            SettingsSeeder::class,
            ContactDetailSeeder::class,
            PageSeeder::class,
            MenuSeeder::class,

            // Catalog
            VehicleCategorySeeder::class,
            VehicleSeeder::class,
            ServiceSeeder::class,
            TourPackageSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            HeroSliderSeeder::class,
            GallerySeeder::class,

            // CRM / bulk demo data (depends on Vehicles for Bookings)
            CustomerSeeder::class,
            BookingSeeder::class,
            EnquirySeeder::class,
        ]);
    }
}
