<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Booking;
use App\Models\User;
use Database\Factories\ActivityFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Activity::factory(5)->create()->each(function ($activity){
            Booking::factory(10)->create(['activity_id' => $activity->id]);
        });
        /* $this->call([
            ActivitySeeder::class,
        ]); */
    }
}
