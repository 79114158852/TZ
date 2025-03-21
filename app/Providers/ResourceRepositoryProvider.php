<?php

namespace App\Providers;

use App\Contracts\Repositories\ResourceRepositoryContract;
use App\Repositories\ResourceRepository;
use Illuminate\Support\ServiceProvider;

/**
 * @psalm-api
 */
class ResourceRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ResourceRepositoryContract::class, ResourceRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
