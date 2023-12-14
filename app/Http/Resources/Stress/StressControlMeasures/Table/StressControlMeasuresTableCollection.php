<?php

namespace App\Http\Resources\Stress\StressControlMeasures\Table;

use App\Models\Stress\StressControlMeasures;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\StressControlMeasures\Table\StressControlMeasuresTableResource;

class StressControlMeasuresTableCollection extends ResourceCollection
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
            'columns' => StressControlMeasures::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StressControlMeasuresTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
