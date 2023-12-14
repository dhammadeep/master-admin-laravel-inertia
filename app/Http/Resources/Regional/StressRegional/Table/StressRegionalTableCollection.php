<?php

namespace App\Http\Resources\Regional\StressRegional\Table;

use App\Models\Regional\StressRegional;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Regional\StressRegional\Table\StressRegionalTableResource;

class StressRegionalTableCollection extends ResourceCollection
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
            'columns' => StressRegional::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StressRegionalTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
