<?php

namespace App\Providers;

use App\Contracts\Services\BookingServiceContract;
use App\Services\BookingService;
use Illuminate\Support\ServiceProvider;

/**
 * @psalm-api
 */
class BookingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BookingServiceContract::class, BookingService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
