<?php

namespace App\Providers;

use App\Contracts\Observers\BookingObserverContract;
use App\Observers\BookingObserver;
use Illuminate\Support\ServiceProvider;

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
