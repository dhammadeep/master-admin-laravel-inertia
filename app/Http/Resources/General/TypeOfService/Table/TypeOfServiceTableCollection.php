<?php

namespace App\Http\Resources\General\TypeOfService\Table;

use App\Models\General\TypeOfService;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\General\TypeOfService\Table\TypeOfServiceTableResource;

class TypeOfServiceTableCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'columns' => TypeOfService::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new TypeOfServiceTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
