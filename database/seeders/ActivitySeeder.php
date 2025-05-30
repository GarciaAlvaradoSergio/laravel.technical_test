<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::factory()->count(20)->create();

        //Crear actividades populares
        Activity::factory()->count(5)->popular()->create();
    }
}
