<?php

namespace App\Services;

use App\Contracts\Repositories\ResourceRepositoryContract;
use App\Contracts\Services\ResourceServiceContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ResourceService implements ResourceServiceContract
{
    public function __construct(
        protected ResourceRepositoryContract $resourceRepository
    ) {}

    public function create(array $attributes): Model
    {
        return $this->resourceRepository->create($attributes);
    }

    public function getAll(): ?Collection
    {
        return $this->resourceRepository->getAll();
    }

    public function getBookings(int $id): ?Collection
    {
        return $this->resourceRepository->getBookings($id);
    }
}
