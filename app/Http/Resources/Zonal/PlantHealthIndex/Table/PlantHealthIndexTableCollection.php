<?php

namespace App\Http\Resources\Zonal\PlantHealthIndex\Table;

use App\Models\Zonal\PlantHealthIndex;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\PlantHealthIndex\Table\PlantHealthIndexTableResource;

class PlantHealthIndexTableCollection extends ResourceCollection
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
            'columns' => PlantHealthIndex::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new PlantHealthIndexTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
