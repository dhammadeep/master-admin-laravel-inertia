<?php

namespace App\Http\Resources\Phenophase\CommodityPhenophase\Table;

use App\Models\Phenophase\CommodityPhenophase;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Phenophase\CommodityPhenophase\Table\CommodityPhenophaseTableResource;

class CommodityPhenophaseTableCollection extends ResourceCollection
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
            'columns' => CommodityPhenophase::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new CommodityPhenophaseTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
