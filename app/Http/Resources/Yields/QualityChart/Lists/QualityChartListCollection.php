<?php

namespace App\Http\Resources\Yields\QualityChart\Lists;

use App\Http\Resources\Common\Option\OptionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Yields\QualityChart\QualityChartDetailResource;

class QualityChartListCollection extends ResourceCollection
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
                return new QualityChartDetailResource($data);
            })->all()
        ];
    }
}
