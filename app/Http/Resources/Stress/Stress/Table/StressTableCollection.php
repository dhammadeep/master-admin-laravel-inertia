<?php

namespace App\Http\Resources\Stress\Stress\Table;

use App\Models\Stress\Stress;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\Stress\Table\StressTableResource;

class StressTableCollection extends ResourceCollection
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
            'columns' => Stress::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StressTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
