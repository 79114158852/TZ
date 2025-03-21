<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Resources
    Route::post('/resources', [App\Http\API\Controllers\ResourceController::class, 'createResource']);
    Route::get('/resources', [App\Http\API\Controllers\ResourceController::class, 'getResources']);
    Route::get('/resources/{id}/bookings', [App\Http\API\Controllers\ResourceController::class, 'getBookings']);

    // Bookings
    Route::post('/bookings', [App\Http\API\Controllers\BookingController::class, 'createBooking']);
    Route::delete('/bookings/{id}', [App\Http\API\Controllers\BookingController::class, 'deleteBooking']);
});
