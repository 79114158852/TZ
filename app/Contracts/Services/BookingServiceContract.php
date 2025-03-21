<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Model;

interface BookingServiceContract
{
    /**
     * Create booking record
     */
    public function create(array $attributes): Model;

    /**
     * Delete booking record
     */
    public function delete(int $bookingId): bool;
}
