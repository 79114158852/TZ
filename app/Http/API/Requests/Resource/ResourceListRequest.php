<?php

namespace App\Http\API\Requests\Resource;

/**
 * @summary Получение списка всех ресурсов
 *
 * @_200 Успешное выполнение операции
 *
 * @_401 Требуется авторизация
 */
class ResourceListRequest extends \Illuminate\Foundation\Http\FormRequest {}
