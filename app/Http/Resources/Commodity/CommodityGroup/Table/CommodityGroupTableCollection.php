<?php

namespace App\Http\Resources\Commodity\CommodityGroup\Table;

use App\Models\Commodity\CommodityGroup;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\CommodityGroup\Table\CommodityGroupTableResource;

class CommodityGroupTableCollection extends ResourceCollection
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
            'columns' => CommodityGroup::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new CommodityGroupTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
