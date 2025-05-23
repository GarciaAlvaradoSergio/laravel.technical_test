<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    protected $model = Activity::class;
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 month');
        $endDate = Carbon::parse($startDate)->addDays(rand(1, 30));
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->text(100),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'price_per_person' => $this->faker->randomFloat(2, 10, 500),
            'popularity' => $this->faker->numberBetween(1, 100),
        ];
    }
    
    public function popular()
    {
        return $this->state(function (array $attributes) {
            return [
                'popularity' => $this->faker->numberBetween(80, 100),
            ];
        });
    }
}
