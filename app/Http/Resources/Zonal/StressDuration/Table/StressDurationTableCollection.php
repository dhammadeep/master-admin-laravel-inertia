<?php

namespace App\Http\Resources\Zonal\StressDuration\Table;

use App\Models\Zonal\StressDuration;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\StressDuration\Table\StressDurationTableResource;

class StressDurationTableCollection extends ResourceCollection
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
            'columns' => StressDuration::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StressDurationTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
