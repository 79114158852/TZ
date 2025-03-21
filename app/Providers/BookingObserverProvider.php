<?php

namespace App\Providers;

use App\Observers\BookingObserver;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Observers\BookingObserverContract;

/**
 * @psalm-api
 */
class BookingObserverProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BookingObserverContract::class, BookingObserver::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
