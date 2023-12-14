<?php

namespace App\Http\Resources\Stress\StressStage\Table;

use App\Models\Stress\StressStage;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\StressStage\Table\StressStageTableResource;

class StressStageTableCollection extends ResourceCollection
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
            'columns' => StressStage::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StressStageTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
