<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Booking;
use App\Models\Resource;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ResourceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * POST /api/resources unauthorized
     */
    public function test_resources_post_guest(): void
    {
        $response = $this->postJson('/api/resources', []);
        $response->assertUnauthorized();
    }

    /**
     * POST /api/resources not valid
     */
    public function test_resources_post_not_valid(): void
    {
        Sanctum::actingAs($this->getUser());
        $response = $this->postJson('/api/resources', ['name' => fake()->word()]);
        $response->assertUnprocessable();
    }

    /**
     * POST /api/resources success
     */
    public function test_resources_post_success(): void
    {
        Sanctum::actingAs($this->getUser());
        $response = $this->postJson('/api/resources', ['name' => fake()->word(), 'type' => fake()->word()]);
        $response->assertCreated();
    }

    /**
     * GET /api/resources unauthorized
     */
    public function test_resources_get_guest(): void
    {
        $response = $this->getJson('/api/resources');
        $response->assertUnauthorized();
    }

    /**
     * GET /api/resources success
     */
    public function test_resources_get_success(): void
    {
        $user = $this->getUser();
        Resource::factory()->afterCreating(function (Resource $resource) use ($user) {
            Booking::factory()->count(5)->create(['user_id' => $user->id, 'resource_id' => $resource->id]);
        })->count(5)->create();
        Sanctum::actingAs($user);
        $response = $this->getJson('/api/resources');
        $response->assertOk();
        $response->assertJson(fn (AssertableJson $json) => $json->has('data.0', fn (AssertableJson $json) => $json
                ->whereType('id', 'integer')
                ->whereType('name', 'string')
                ->whereType('type', 'string')
                ->whereType('description', 'string|null')
                ->whereType('created_at', 'string|null')
                ->whereType('updated_at', 'string|null')
            )
        );
    }

    /**
     * GET /api/resources/{id}/bookings guest
     */
    public function test_resources_get_bookings_guest(): void
    {
        $user = $this->getUser();
        $resource = Resource::factory()->afterCreating(function (Resource $resource) use ($user) {
            Booking::factory()->count(5)->create(['user_id' => $user->id, 'resource_id' => $resource->id]);
        })->create()->first();
        $response = $this->getJson('/api/resources/'.$resource->id.'/bookings');
        $response->assertUnauthorized();
    }

    /**
     * GET /api/resources/{id}/bookings not found resource
     */
    public function test_resources_get_bookings_not_found(): void
    {
        Sanctum::actingAs($this->getUser());
        $response = $this->getJson('/api/resources/0/bookings');
        $response->assertNotFound();
    }

    /**
     * GET /api/resources/{id}/bookings success
     */
    public function test_resources_get_bookings_success(): void
    {
        $user = $this->getUser();
        $resource = Resource::factory()->afterCreating(function (Resource $resource) use ($user) {
            Booking::factory()->count(5)->create(['user_id' => $user->id, 'resource_id' => $resource->id]);
        })->create()->first();
        Sanctum::actingAs($user);
        $response = $this->getJson('/api/resources/'.$resource->id.'/bookings');
        $response->assertOk();
        $response->assertJson(fn (AssertableJson $json) => $json->has('data.0', fn (AssertableJson $json) => $json
                ->whereType('id', 'integer')
                ->whereType('user', 'array')
                ->whereType('start_time', 'string')
                ->whereType('end_time', 'string|null')
                ->whereType('created_at', 'string|null')
                ->whereType('updated_at', 'string|null')
            )
        );
    }
}
