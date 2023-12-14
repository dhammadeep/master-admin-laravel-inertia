<?php

namespace App\Http\Resources\Commodity\PlantPart\Table;

use App\Models\Commodity\PlantPart;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\PlantPart\Table\PlantPartTableResource;

class PlantPartTableCollection extends ResourceCollection
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
            'columns' => PlantPart::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new PlantPartTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
