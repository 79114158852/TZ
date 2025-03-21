<?php

namespace App\Http\API\Controllers;

use App\Contracts\Services\ResourceServiceContract;
use App\Http\API\Requests\Resource\BookingListRequest;
use App\Http\API\Requests\Resource\CreateResourceRequest;
use App\Http\API\Requests\Resource\ResourceListRequest;
use App\Http\API\Resources\Booking\BookingCollection;
use App\Http\API\Resources\Resource\ResourceCollection;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class ResourceController extends Controller
{
    /**
     * Create resource
     */
    public function createResource(
        CreateResourceRequest $request,
        ResourceServiceContract $resourceService
    ): JsonResponse {
        try {
            $resourceService->create($request->validated());

            return new JsonResponse(
                ['message' => 'Resource was created successfully'],
                201
            );
        } catch (Throwable $e) {
            abort(500, $e->getMessage());
        }
    }

    /**
     * Get all resources
     */
    public function getResources(
        ResourceListRequest $request,
        ResourceServiceContract $resourceService
    ): ResourceCollection {
        try {
            return new ResourceCollection(
                $resourceService->getAll()
            );
        } catch (Throwable $e) {
            abort(500, $e->getMessage());
        }
    }

    /**
     * Get bookings for resource
     */
    public function getBookings(
        int $id,
        BookingListRequest $request,
        ResourceServiceContract $resourceService
    ): BookingCollection {
        try {
            return new BookingCollection(
                $resourceService->getBookings($id)
            );
        } catch (ModelNotFoundException $e) {
            abort(404, 'Resource not exist');
        } catch (Throwable $e) {
            abort(500, $e->getMessage());
        }
    }
}
