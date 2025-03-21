<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ResourceServiceContract
{
    /**
     * Create resource record
     */
    public function create(array $attributes): Model;

    /**
     * Get all resources
     */
    public function getAll(): ?Collection;

    /**
     * Get all bookings for resource
     */
    public function getBookings(int $id): ?Collection;
}
