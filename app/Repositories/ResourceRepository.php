<?php

namespace App\Repositories;

use App\Contracts\Repositories\ResourceRepositoryContract;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Collection;

class ResourceRepository implements ResourceRepositoryContract
{
    public function __construct(
        protected Resource $resource
    ) {}

    public function getAll(): Collection
    {
        return $this->resource->all();
    }

    public function create(array $attributes): Resource
    {
        return $this->resource->create($attributes);
    }

    public function getBookings(int $id): ?Collection
    {
        return $this->resource->findOrFail($id)->bookings();
    }
}
