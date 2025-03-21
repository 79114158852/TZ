<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Models\Resource;
use App\Observers\BookingObserver;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ObserverTest extends TestCase
{
    use DatabaseTransactions;

    public function test_observer_booking_created()
    {
        $bookingsObserver = \Mockery::mock(BookingObserver::class);
        $bookingsObserver->shouldReceive('created')->once();
        app()->instance(BookingObserver::class, $bookingsObserver);
        $user = $this->getUser();
        $resource = Resource::factory()->create()->first();
        Booking::factory()->create(['resource_id' => $resource->id, 'user_id' => $user->id]);
    }

    public function test_observer_booking_deleted()
    {
        $user = $this->getUser();
        $resource = Resource::factory()->create()->first();
        $booking = Booking::factory()->create(['resource_id' => $resource->id, 'user_id' => $user->id])->first();
        $bookingsObserver = \Mockery::mock(BookingObserver::class);
        $bookingsObserver->shouldReceive('deleted')->once();
        app()->instance(BookingObserver::class, $bookingsObserver);
        $booking->delete();
    }
}
