<?php

namespace App\Http\Resources\Zonal\ZonalCommodity\Lists;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\ZonalCommodity\ZonalCommodityDetailResource;

class ZonalCommodityListCollection extends ResourceCollection
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
            'data' => $this->collection->map(function ($data) {
                return new ZonalCommodityDetailResource($data);
            })->all()
        ];
    }
}
