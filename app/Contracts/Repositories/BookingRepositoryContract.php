<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BookingRepositoryContract
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
