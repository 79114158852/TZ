<?php

namespace App\Http\API\Requests\Resource;

/**
 * @summary Получение всех бронирований для ресурса
 *
 * @_200 Успешное выполнение операции
 *
 * @_401 Требуется авторизация
 *
 * @_404 Ресурс не существует
 */
class BookingListRequest extends \Illuminate\Foundation\Http\FormRequest {}
