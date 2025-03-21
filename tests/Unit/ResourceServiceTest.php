<?php

namespace Tests\Unit;

use App\Contracts\Services\ResourceServiceContract;
use App\Models\Booking;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ResourceServiceTest extends TestCase
{
    use DatabaseTransactions;

    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(ResourceServiceContract::class);
    }

    /**
     * Create resource service error.
     */
    public function test_create_error(): void
    {
        $this->expectExceptionMessageMatches('/Too few arguments to function.*/');
        $this->service->create();
    }

    /**
     * Create resource service success.
     */
    public function test_create_success(): void
    {
        $name = microtime(true);
        $type = microtime(true);
        $response = $this->service->create(['name' => $name, 'type' => $type]);
        $this->assertTrue(
            $response instanceof Resource &&
            $response->name == $name &&
            $response->type == $type
        );
    }

    /**
     * Get resources success
     */
    public function test_get_resources_success()
    {
        Resource::factory()->create();
        $this->assertNotNull(
            $this->service->getAll()
        );
    }

    /**
     * Get bookings success
     */
    public function test_get_bookings_success()
    {
        $user = $this->getUser();
        $resources = Resource::factory()->afterCreating(function (Resource $resource) use ($user) {
            Booking::factory()->count(5)->create(['user_id' => $user->id, 'resource_id' => $resource->id]);
        })->create();
        $this->assertTrue(
            $this->service->getBookings($resources->first()->id) instanceof Collection
        );
    }

    /**
     * Get bookings not found
     */
    public function test_get_bookings_not_found()
    {
        $this->expectExceptionMessageMatches('/No query results for model.*/');
        $this->service->getBookings(0);
    }
}
