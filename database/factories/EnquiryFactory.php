<?php

namespace Database\Factories;

use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enquiry>
 */
class EnquiryFactory extends Factory
{
    protected function withFaker(): \Faker\Generator
    {
        return \Faker\Factory::create('en_IN');
    }

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => '9'.$this->faker->numerify('#########'),
            'email' => $this->faker->safeEmail(),
            'message' => $this->faker->sentence(),
            'customer_id' => null,
            'status' => $this->faker->randomElement(['new', 'contacted', 'interested', 'follow_up', 'converted', 'closed']),
        ];
    }
}
