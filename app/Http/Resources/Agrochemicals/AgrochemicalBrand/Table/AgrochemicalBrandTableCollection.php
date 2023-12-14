<?php

namespace App\Http\Resources\Agrochemicals\AgrochemicalBrand\Table;

use App\Models\Agrochemicals\AgrochemicalBrand;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agrochemicals\AgrochemicalBrand\Table\AgrochemicalBrandTableResource;

class AgrochemicalBrandTableCollection extends ResourceCollection
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
            'columns' => AgrochemicalBrand::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new AgrochemicalBrandTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
