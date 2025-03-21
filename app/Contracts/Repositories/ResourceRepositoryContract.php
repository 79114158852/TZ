<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ResourceRepositoryContract
{
    /**
     * Get all resources
     */
    public function getAll(): Collection;

    /**
     * Create resource
     */
    public function create(array $attributes): Model;

    /**
     * Get bookings for resource
     */
    public function getBookings(int $id): ?Collection;
}
