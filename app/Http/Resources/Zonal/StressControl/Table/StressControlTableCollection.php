<?php

namespace App\Http\Resources\Zonal\StressControl\Table;

use App\Models\Zonal\StressControl;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\StressControl\Table\StressControlTableResource;

class StressControlTableCollection extends ResourceCollection
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
            'columns' => StressControl::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StressControlTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
