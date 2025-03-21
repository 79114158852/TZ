<?php

namespace App\Http\API\Requests\Booking;

/**
 * @summary Создание бронирования
 *
 * @_201 Успешное выполнение операции
 *
 * @_401 Требуется атворизация
 *
 * @_422 Невалидные данные
 */
class CreateBookingRequest extends \Illuminate\Foundation\Http\FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        return [
            'resource_id' => 'required|integer|exists:App\Models\Resource,id',
            'user_id' => 'required|integer|exists:App\Models\User,id',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s',
        ];
    }
}
