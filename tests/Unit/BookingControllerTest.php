<?php

use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_crear_una_reserva()
    {
        $actividad = Activity::factory()->create(['price_per_person' => 60.00]);

        $respuesta = $this->postJson('/api/bookings', [
            'activity_id' => $actividad->id,
            'people' => 4,
            'activity_date' => '2023-07-20'
        ]);

        $respuesta->assertStatus(201)
            ->assertJson([
                'people' => 4,
                'booking_price' => 240.00 // 4 * 60.00
            ]);
    }
}
