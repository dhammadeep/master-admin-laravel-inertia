<?php

namespace App\Http\Resources\Agriculture\SourceOfWater\Table;

use App\Models\Agriculture\SourceOfWater;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\SourceOfWater\Table\SourceOfWaterTableResource;

class SourceOfWaterTableCollection extends ResourceCollection
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
            'columns' => SourceOfWater::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new SourceOfWaterTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
