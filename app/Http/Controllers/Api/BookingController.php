<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'people' => 'required|integer|min:1',
            'activity_date' => 'required|date'
        ]);
        
        $activity = Activity::find($validated['activity_id']);
        
        $booking = Booking::create([
            'activity_id' => $validated['activity_id'],
            'people' => $validated['people'],
            'booking_price' => $activity->price_per_person * $validated['people'],
            'booking_date' => now(),
            'activity_date' => $validated['activity_date']
        ]);
        
        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
