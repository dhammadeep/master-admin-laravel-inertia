<?php

namespace App\Http\Resources\Commodity\CommodityPlantPart\Table;

use App\Models\Commodity\CommodityPlantPart;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\CommodityPlantPart\Table\CommodityPlantPartTableResource;

class CommodityPlantPartTableCollection extends ResourceCollection
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
            'columns' => CommodityPlantPart::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new CommodityPlantPartTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
