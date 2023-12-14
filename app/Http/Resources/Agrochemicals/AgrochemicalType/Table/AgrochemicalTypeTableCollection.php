<?php

namespace App\Http\Resources\Agrochemicals\AgrochemicalType\Table;

use App\Models\Agrochemicals\AgrochemicalType;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agrochemicals\AgrochemicalType\Table\AgrochemicalTypeTableResource;

class AgrochemicalTypeTableCollection extends ResourceCollection
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
            'columns' => AgrochemicalType::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new AgrochemicalTypeTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
