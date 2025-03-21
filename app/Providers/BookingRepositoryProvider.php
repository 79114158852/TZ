<?php

namespace App\Providers;

use App\Contracts\Repositories\BookingRepositoryContract;
use App\Repositories\BookingRepository;
use Illuminate\Support\ServiceProvider;

/**
 * @psalm-api
 */
class BookingRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BookingRepositoryContract::class, BookingRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
