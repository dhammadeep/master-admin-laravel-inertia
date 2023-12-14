<?php

namespace App\Http\Resources\Commodity\CommodityClass\Table;

use App\Models\Commodity\CommodityClass;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\CommodityClass\Table\CommodityClassTableResource;

class CommodityClassTableCollection extends ResourceCollection
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
            'columns' => CommodityClass::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new CommodityClassTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
