<?php

use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;
    public function test_puede_crear_una_actividad()
    {
        $activity = Activity::factory()->create([
            'title' => 'Tour por la ciudad',
            'price_per_person' => 50.00
        ]);

        $this->assertDatabaseHas('activities', [
            'title' => 'Tour por la ciudad',
            'price_per_person' => 50.00
        ]);
    }

    public function test_una_actividad_puede_tener_actividades_relacionadas()
    {
        $activity1 = Activity::factory()->create();
        $activity2 = Activity::factory()->create();

        $activity1->recommendedActivities()->attach($activity2);

        $this->assertCount(1, $activity1->recommendedActivities);
        $this->assertEquals($activity2->id, $activity1->recommendedActivities->first()->id);
    }
}
