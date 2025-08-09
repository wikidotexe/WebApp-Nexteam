<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    public function definition(): array
    {
        $subTotal = $this->faker->randomFloat(2, 100, 1000);
        $tax = $subTotal * 0.1;

        return [
            'client_id' => Client::factory(),
            'project_id' => Project::factory(),
            'number' => strtoupper($this->faker->bothify('2025-INV-####')),
            'invoice_date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'sub_total' => $subTotal,
            'tax' => $tax,
            'total' => $subTotal + $tax,
            'status' => $this->faker->randomElement(['unpaid','paid','partial','overdue']),
            'notes' => $this->faker->sentence,
        ];
    }
}
