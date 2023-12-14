<?php

namespace App\Http\Resources\Agrochemicals\Agrochemical\Table;

use App\Models\Agrochemicals\Agrochemical;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agrochemicals\Agrochemical\Table\AgrochemicalTableResource;

class AgrochemicalTableCollection extends ResourceCollection
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
            'columns' => Agrochemical::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new AgrochemicalTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
