<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    protected const TOTAL = 25;

    public function run(): void
    {
        $curated = [
            ['customer_name' => 'Rajesh Kumar', 'rating' => 5, 'review' => 'Excellent service! The driver was punctual and the car was very clean. Highly recommend MNU Travels for outstation trips.'],
            ['customer_name' => 'Priya Sharma', 'rating' => 5, 'review' => 'Booked a tour package for our family trip to Udaipur and everything was perfectly arranged. Great experience overall.'],
            ['customer_name' => 'Amit Verma', 'rating' => 4, 'review' => 'Reliable airport transfer service. The driver tracked my flight and was waiting for me right on time.'],
            ['customer_name' => 'Sneha Patel', 'rating' => 5, 'review' => 'Used their corporate taxi service for a business trip. Professional drivers and comfortable vehicles.'],
            ['customer_name' => 'Vikram Singh', 'rating' => 5, 'review' => 'Went for Khatu Shyam darshan with the family, smooth booking and very courteous driver throughout the trip.'],
            ['customer_name' => 'Anita Desai', 'rating' => 4, 'review' => 'Good experience with the Jaipur local sightseeing package - covered all major spots comfortably in a day.'],
        ];

        foreach ($curated as $testimonial) {
            Testimonial::query()->firstOrCreate(
                ['customer_name' => $testimonial['customer_name']],
                $testimonial + ['status' => 'active']
            );
        }

        $existing = Testimonial::count();

        if ($existing < self::TOTAL) {
            Testimonial::factory()->count(self::TOTAL - $existing)->create();
        }
    }
}
