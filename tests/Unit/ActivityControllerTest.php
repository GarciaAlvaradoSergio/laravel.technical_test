<?php

use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_buscar_actividades_disponibles()
    {
        $activity = Activity::factory()->create([
            'start_date' => '2025-05-27',
            'end_date' => '2025-07-15',
            'popularity' => 5
        ]);

        $response = $this->getJson('/api/activities?date=2025-05-27&people=2');

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'title' => $activity->title
            ]);
    }
    public function test_la_busqueda_requiere_una_fecha_valida()
    {
        $response = $this->getJson('/api/activities?date=invalid-date&people=2');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['date']);
    }

    public function test_puede_obtener_detalles_de_una_actividad()
    {
        $activity = Activity::factory()->create();

        $response = $this->getJson("/api/activities/{$activity->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $activity->id,
                'title' => $activity->title
            ]);
    }
}
