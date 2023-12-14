<?php

namespace App\Http\Resources\Commodity\CommodityAlias\Table;

use App\Models\Commodity\CommodityAlias;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\CommodityAlias\Table\CommodityAliasTableResource;

class CommodityAliasTableCollection extends ResourceCollection
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
            'columns' => CommodityAlias::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new CommodityAliasTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
