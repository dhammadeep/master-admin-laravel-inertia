<?php

namespace App\Http\Resources\Zonal\StandardQuantityChart\Table;

use App\Models\Zonal\StandardQuantityChart;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\StandardQuantityChart\Table\StandardQuantityChartTableResource;

class StandardQuantityChartTableCollection extends ResourceCollection
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
            'columns' => StandardQuantityChart::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StandardQuantityChartTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
