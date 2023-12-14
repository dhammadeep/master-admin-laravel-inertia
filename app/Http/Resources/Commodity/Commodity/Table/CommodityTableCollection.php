<?php

namespace App\Http\Resources\Commodity\Commodity\Table;

use App\Models\Commodity\Commodity;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\Commodity\Table\CommodityTableResource;

class CommodityTableCollection extends ResourceCollection
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
            'columns' => Commodity::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new CommodityTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
