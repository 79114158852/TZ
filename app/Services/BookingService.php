<?php

namespace App\Services;

use App\Contracts\Repositories\BookingRepositoryContract;
use App\Contracts\Services\BookingServiceContract;
use Illuminate\Database\Eloquent\Model;

class BookingService implements BookingServiceContract
{
    public function __construct(
        protected BookingRepositoryContract $bookingRepository
    ) {}

    public function create(array $attributes): Model
    {
        return $this->bookingRepository->create($attributes);
    }

    public function delete(int $bookingId): bool
    {
        return $this->bookingRepository->delete($bookingId);
    }
}
