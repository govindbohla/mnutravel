<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    protected function withFaker(): \Faker\Generator
    {
        return \Faker\Factory::create('en_IN');
    }

    public function definition(): array
    {
        $tripType = $this->faker->randomElement(['one_way', 'round_trip']);
        $journeyDate = $this->faker->dateTimeBetween('-2 months', '+1 month');

        return [
            'booking_no' => 'MNU-'.$this->faker->unique()->numerify('######'),
            'trip_type' => $tripType,
            'pickup_location' => $this->faker->city(),
            'drop_location' => $this->faker->city(),
            'journey_date' => $journeyDate->format('Y-m-d'),
            'journey_time' => $this->faker->time('H:i:s'),
            'return_date' => $tripType === 'round_trip'
                ? $this->faker->dateTimeBetween($journeyDate, (clone $journeyDate)->modify('+10 days'))->format('Y-m-d')
                : null,
            'vehicle_id' => Vehicle::factory(),
            'customer_id' => null,
            'customer_name' => $this->faker->name(),
            'phone' => '9'.$this->faker->numerify('#########'),
            'email' => $this->faker->safeEmail(),
            'message' => $this->faker->optional(0.4)->sentence(),
            'status' => $this->faker->randomElement(['new', 'pending', 'confirmed', 'completed', 'cancelled']),
        ];
    }
}
