<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimesheetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'work_date' => $this->faker->date(),
            'hours' => $this->faker->randomFloat(2, 1, 8),
            'notes' => $this->faker->sentence,
        ];
    }
}
