<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'rate' => $this->faker->randomFloat(2, 50, 500),
            'billing_type' => $this->faker->randomElement(['fixed', 'hourly']),
            'amount' => $this->faker->randomFloat(2, 500, 5000),
            'status' => $this->faker->randomElement(['draft','active','completed','cancelled']),
            'start_date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
        ];
    }
}
