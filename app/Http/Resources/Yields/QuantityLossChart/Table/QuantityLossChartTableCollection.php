<?php

namespace App\Http\Resources\Yields\QuantityLossChart\Table;

use App\Models\Yields\QuantityLossChart;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Yields\QuantityLossChart\Table\QuantityLossChartTableResource;

class QuantityLossChartTableCollection extends ResourceCollection
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
            'columns' => QuantityLossChart::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new QuantityLossChartTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
