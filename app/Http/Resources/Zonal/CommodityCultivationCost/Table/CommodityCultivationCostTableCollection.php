<?php

namespace App\Http\Resources\Zonal\CommodityCultivationCost\Table;

use App\Models\Zonal\CommodityCultivationCost;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\CommodityCultivationCost\Table\CommodityCultivationCostTableResource;

class CommodityCultivationCostTableCollection extends ResourceCollection
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
            'columns' => CommodityCultivationCost::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new CommodityCultivationCostTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
