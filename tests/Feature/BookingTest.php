<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Contracts\Observers\BookingObserverContract;
use App\Models\Booking;
use App\Models\Resource;
use App\Observers\BookingObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        // Bind fake observer while testing
        app()->instance(
            BookingObserver::class, new DummyObserver
        );
    }

    /**
     * POST /api/bookings unauthorized
     */
    public function test_bookings_post_guest(): void
    {
        $response = $this->postJson('/api/bookings', []);
        $response->assertUnauthorized();
    }

    /**
     * POST /api/bookings not valid
     */
    public function test_bookings_post_not_valid(): void
    {
        Sanctum::actingAs($this->getUser());
        $response = $this->postJson('/api/resources', ['name' => fake()->word()]);
        $response->assertUnprocessable();
    }

    /**
     * POST /api/bookings success
     */
    public function test_bookings_post_success(): void
    {
        $user = $this->getUser();
        $resource = Resource::factory()->create()->first();
        Sanctum::actingAs($user);
        $response = $this->postJson(
            '/api/bookings',
            [
                'resource_id' => $resource->id,
                'user_id' => $user->id,
                'start_time' => date('Y-m-d H:i:s'),
                'end_time' => date('Y-m-d H:i:s'),
            ]
        );
        $response->assertCreated();
    }

    /**
     * DELETE /api/bookings/{id} unauthorized
     */
    public function test_bookings_delete_guest(): void
    {
        $response = $this->deleteJson('/api/bookings/0');
        $response->assertUnauthorized();
    }

    /**
     * DELETE /api/bookings/{id} not found
     */
    public function test_bookings_delete_not_found(): void
    {
        Sanctum::actingAs($this->getUser());
        $response = $this->deleteJson('/api/bookings/0');
        $response->assertNotFound();
    }

    /**
     * DELETE /api/bookings/{id} success
     */
    public function test_bookings_delete_success(): void
    {
        $user = $this->getUser();
        $resource = Resource::factory()->create()->first();
        $booking = Booking::factory()->create(['user_id' => $user->id, 'resource_id' => $resource->id])->first();
        Sanctum::actingAs($user);
        $response = $this->deleteJson('/api/bookings/'.$booking->id);
        $response->assertNoContent();
    }
}

class DummyObserver implements BookingObserverContract
{
    public function created(Model $mode): void
    {
        // Do nothing while testing
    }

    public function deleted(Model $booking): void
    {
        // Do nothing while testing
    }
}
