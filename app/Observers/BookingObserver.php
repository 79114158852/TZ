<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Observers\BookingObserverContract;

class BookingObserver implements BookingObserverContract
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Model $booking): void
    {
        // Created logic
    }
    
    /**
     * Handle the Booking "deleted" event.
     */
    public function deleted(Model $booking): void
    {
        // Deleted logic
    }
}
