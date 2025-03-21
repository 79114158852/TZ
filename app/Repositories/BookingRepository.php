<?php

namespace App\Repositories;

use App\Contracts\Repositories\BookingRepositoryContract;
use App\Models\Booking;

class BookingRepository implements BookingRepositoryContract
{
    public function __construct(
        protected Booking $booking
    ) {}

    /**
     * @throws
     */
    public function create(array $attributes): Booking
    {
        return $this->booking->create($attributes);
    }

    /**
     * @throws ModelNotFound if booking not exist
     */
    public function delete(int $bookingId): bool
    {
        return $this->booking->findOrFail($bookingId)->delete();
    }
}
