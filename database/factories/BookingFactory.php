<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;
    public function definition(): array
    {
        return [
            'activity_id' => Activity::factory(),
            'people' => $this->faker->numberBetween(1, 10),
            'booking_price' => $this->faker->randomFloat(2, 20, 500),
            'booking_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'activity_date' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
