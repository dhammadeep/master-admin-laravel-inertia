<?php

namespace App\Http\Resources\Yields\QuantityLossChart\Lists;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Yields\QuantityLossChart\QuantityLossChartDetailResource;

class QuantityLossChartListCollection extends ResourceCollection
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
                return new QuantityLossChartDetailResource($data);
            })->all()
        ];
    }
}
