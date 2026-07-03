<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    protected function withFaker(): \Faker\Generator
    {
        return \Faker\Factory::create('en_IN');
    }

    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name(),
            'image' => null,
            'rating' => $this->faker->numberBetween(4, 5),
            'review' => $this->faker->paragraph(),
            'status' => 'active',
        ];
    }
}
