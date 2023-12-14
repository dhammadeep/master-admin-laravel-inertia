<?php

namespace App\Http\Resources\Stress\StressType\Table;

use App\Models\Stress\StressType;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\StressType\Table\StressTypeTableResource;

class StressTypeTableCollection extends ResourceCollection
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
            'columns' => StressType::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StressTypeTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
