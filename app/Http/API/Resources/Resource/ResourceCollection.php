<?php

namespace App\Http\API\Resources\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection as CoreResourceCollection;

class ResourceCollection extends CoreResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<mixed>|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
