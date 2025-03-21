<?php
namespace App\Contracts\Observers;

use Illuminate\Database\Eloquent\Model;

interface BookingObserverContract {
    public function created(Model $booking): void;
    public function deleted(Model $booking): void;
}