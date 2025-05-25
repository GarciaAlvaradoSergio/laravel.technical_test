<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\ActivityRecommendation;
use App\Models\Booking;
use App\Models\User;
use Database\Factories\ActivityFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 10 actividades
        $activities = Activity::factory(10)->create();

        $activities->each(function ($activity) use ($activities) {
            // Crear entre 5 y 15 bookings por actividad
            Booking::factory(rand(5, 15))->create(['activity_id' => $activity->id]);

            // Seleccionar 2-4 actividades aleatorias (excluyendo la actual)
            $recommendedActivities = $activities
                ->where('id', '!=', $activity->id)
                ->random(rand(2, 4));

            // Usar la relación directamente sin el modelo pivot
            $activity->recommendedActivities()->attach($recommendedActivities->pluck('id'));
        });
    }

    // Opcional: Si necesitas eliminar duplicados, usa esta versión mejorada
    protected function removeDuplicateRecommendations()
    {
        // Obtener todos los IDs de recomendaciones duplicadas
        $duplicates = DB::table('activity_recommendations')
            ->select('activity_id', 'recommended_id')
            ->groupBy('activity_id', 'recommended_id')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        // Eliminar duplicados
        foreach ($duplicates as $duplicate) {
            // Mantener solo el primero y eliminar los demás
            DB::table('activity_recommendations')
                ->where('activity_id', $duplicate->activity_id)
                ->where('recommended_id', $duplicate->recommended_id)
                ->whereNotIn('id', function ($query) use ($duplicate) {
                    $query->select('id')
                        ->from('activity_recommendations')
                        ->where('activity_id', $duplicate->activity_id)
                        ->where('recommended_id', $duplicate->recommended_id)
                        ->orderBy('id')
                        ->limit(1);
                })
                ->delete();
        }
    }
}
