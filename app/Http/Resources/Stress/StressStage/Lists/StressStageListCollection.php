<?php

namespace App\Http\Resources\Stress\StressStage\Lists;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\StressStage\StressStageDetailResource;

class StressStageListCollection extends ResourceCollection
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
                return new StressStageDetailResource($data);
            })->all()
        ];
    }
}
