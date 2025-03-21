<?php

namespace App\Http\API\Controllers;

use App\Contracts\Services\BookingServiceContract;
use App\Http\API\Requests\Booking\CreateBookingRequest;
use App\Http\API\Requests\Booking\DeleteBookingRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class BookingController extends Controller
{
    /**
     * Create booking
     */
    public function createBooking(
        CreateBookingRequest $request,
        BookingServiceContract $bookingService
    ): JsonResponse {
        try {
            $bookingService->create($request->validated());
            return new JsonResponse(
                ['message' => 'Booking was created successfully'],
                201
            );
        } catch (Throwable $e) {
            abort(500, $e->getMessage());
        }
    }

    /**
     * Delete booking
     */
    public function deleteBooking(
        int $id,
        DeleteBookingRequest $request,
        BookingServiceContract $bookingService
    ): JsonResponse {
        try {
            $bookingService->delete($id);

            return new JsonResponse(
                null, 204
            );
        } catch (ModelNotFoundException $e) {
            abort(404, 'Booking not exist');
        } catch (Throwable $e) {
            abort(500, $e->getMessage());
        }
    }
}
