<?php

namespace App\Http\Resources\Agriculture\BenchmarkVariety\Table;

use App\Models\Agriculture\BenchmarkVariety;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\BenchmarkVariety\Table\BenchmarkVarietyTableResource;

class BenchmarkVarietyTableCollection extends ResourceCollection
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
            'columns' => BenchmarkVariety::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new BenchmarkVarietyTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
