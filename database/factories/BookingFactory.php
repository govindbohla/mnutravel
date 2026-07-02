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
    public function definition(): array
    {
        return [
            'booking_no' => 'MNU-'.$this->faker->unique()->numerify('######'),
            'trip_type' => $this->faker->randomElement(['one_way', 'round_trip']),
            'pickup_location' => $this->faker->city(),
            'drop_location' => $this->faker->city(),
            'journey_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'journey_time' => $this->faker->time('H:i:s'),
            'return_date' => null,
            'vehicle_id' => Vehicle::factory(),
            'customer_id' => null,
            'customer_name' => $this->faker->name(),
            'phone' => $this->faker->numerify('9#########'),
            'email' => $this->faker->safeEmail(),
            'message' => $this->faker->optional()->sentence(),
            'status' => 'new',
        ];
    }
}
