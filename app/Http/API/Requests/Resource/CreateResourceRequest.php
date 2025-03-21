<?php

namespace App\Http\API\Requests\Resource;

/**
 * @summary Создание ресурса
 *
 * @_201 Успешное выполнение операции
 *
 * @_401 Требуется атворизация
 *
 * @_422 Невалидные данные
 */
class CreateResourceRequest extends \Illuminate\Foundation\Http\FormRequest
{
    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'type' => 'required|string',
            'description' => 'nullable|string',
        ];
    }
}
