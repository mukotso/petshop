<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startingDate = Today();
        $endingDate   = strtotime('+1 Week', $startingDate->getTimestamp());
        return [
                'title' => fake()->sentence(),
                'content' => fake()->paragraph(),
                'metadata' => [
                    "valid_from" => $startingDate,
                    "valid_to" => $endingDate
                ],
        ];
    }
}
