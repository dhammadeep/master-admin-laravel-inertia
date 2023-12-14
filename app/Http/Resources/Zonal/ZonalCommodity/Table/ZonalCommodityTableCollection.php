<?php

namespace App\Http\Resources\Zonal\ZonalCommodity\Table;

use App\Models\Zonal\ZonalCommodity;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\ZonalCommodity\Table\ZonalCommodityTableResource;

class ZonalCommodityTableCollection extends ResourceCollection
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
            'columns' => ZonalCommodity::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new ZonalCommodityTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
