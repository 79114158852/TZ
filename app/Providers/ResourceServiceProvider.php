<?php

namespace App\Providers;

use App\Contracts\Services\ResourceServiceContract;
use App\Services\ResourceService;
use Illuminate\Support\ServiceProvider;

/**
 * @psalm-api
 */
class ResourceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ResourceServiceContract::class, ResourceService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
