<?php

namespace App\Http\API\Requests\Booking;

/**
 * @summary Отмена бронирования
 *
 * @_204 Успешное выполнение операции
 *
 * @_401 Требуется атворизация
 *
 * @_404 Бронирование не существует
 */
class DeleteBookingRequest extends \Illuminate\Foundation\Http\FormRequest {}
