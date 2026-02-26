<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Equipment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'startDate' => fake()->date(),
            'endDate' => fake()->date(),
            'totalPrice' => fake()->randomFloat(2, 5, 500),
            'equipment_id' => Equipment::inRandomOrder()->first()->id,
        ];
    }
}
