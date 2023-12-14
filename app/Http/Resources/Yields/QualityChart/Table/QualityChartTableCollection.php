<?php

namespace App\Http\Resources\Yields\QualityChart\Table;

use App\Models\Yields\QualityChart;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Yields\QualityChart\Table\QualityChartTableResource;

class QualityChartTableCollection extends ResourceCollection
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
            'columns' => QualityChart::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new QualityChartTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
