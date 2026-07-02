<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            ['customer_name' => 'Rajesh Kumar', 'rating' => 5, 'review' => 'Excellent service! The driver was punctual and the car was very clean. Highly recommend MNU Travels for outstation trips.'],
            ['customer_name' => 'Priya Sharma', 'rating' => 5, 'review' => 'Booked a tour package for our family trip to Goa and everything was perfectly arranged. Great experience overall.'],
            ['customer_name' => 'Amit Verma', 'rating' => 4, 'review' => 'Reliable airport transfer service. The driver tracked my flight and was waiting for me right on time.'],
            ['customer_name' => 'Sneha Patel', 'rating' => 5, 'review' => 'Used their corporate taxi service for a business trip. Professional drivers and comfortable vehicles.'],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::query()->firstOrCreate(
                ['customer_name' => $testimonial['customer_name']],
                $testimonial + ['status' => 'active']
            );
        }
    }
}
