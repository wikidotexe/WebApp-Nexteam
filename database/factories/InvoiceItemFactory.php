<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemFactory extends Factory
{
    public function definition(): array
    {
        $qty = $this->faker->numberBetween(1, 10);
        $price = $this->faker->randomFloat(2, 10, 200);

        return [
            'invoice_id' => Invoice::factory(),
            'description' => $this->faker->sentence(3),
            'quantity' => $qty,
            'unit_price' => $price,
            'total' => $qty * $price,
        ];
    }
}
