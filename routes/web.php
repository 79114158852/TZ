<?php

use App\Models\Booking;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = User::factory()->create();
    $resource = Resource::factory()->create();
    $booking = new Booking;
    $booking->resource_id = $resource->id;
    $booking->user_id = $user->id;
    $booking->start_time = date('Y-m-d H:i:s');
    $booking->end_time = date('Y-m-d H:i:s');
    $booking->save();
});
