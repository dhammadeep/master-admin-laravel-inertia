<?php

namespace App\Http\Resources\Regional\CommodityRegional\Table;

use App\Models\Regional\CommodityRegional;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Regional\CommodityRegional\Table\CommodityRegionalTableResource;

class CommodityRegionalTableCollection extends ResourceCollection
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
            'columns' => CommodityRegional::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new CommodityRegionalTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
