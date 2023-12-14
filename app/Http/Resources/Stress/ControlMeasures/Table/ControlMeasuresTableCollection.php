<?php

namespace App\Http\Resources\Stress\ControlMeasures\Table;

use App\Models\Stress\ControlMeasures;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\ControlMeasures\Table\ControlMeasuresTableResource;

class ControlMeasuresTableCollection extends ResourceCollection
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
            'columns' => ControlMeasures::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new ControlMeasuresTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
