<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/activities', [ActivityController::class, 'index']);
Route::get('/activities/{activity}', [ActivityController::class, 'show']);
Route::post('/bookings', [BookingController::class, 'store']);
