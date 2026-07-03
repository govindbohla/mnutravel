<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    protected function withFaker(): \Faker\Generator
    {
        return \Faker\Factory::create('en_IN');
    }

    public function definition(): array
    {
        $city = $this->faker->city();

        return [
            'name' => $this->faker->name(),
            'phone' => '9'.$this->faker->numerify('#########'),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->streetAddress().', '.$city.', '.$this->faker->state().' - '.$this->faker->postcode(),
            'notes' => null,
            'status' => $this->faker->randomElement(['active', 'active', 'active', 'inactive']),
        ];
    }
}
