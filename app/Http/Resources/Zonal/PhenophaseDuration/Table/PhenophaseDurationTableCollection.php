<?php

namespace App\Http\Resources\Zonal\PhenophaseDuration\Table;

use App\Models\Zonal\PhenophaseDuration;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\PhenophaseDuration\Table\PhenophaseDurationTableResource;

class PhenophaseDurationTableCollection extends ResourceCollection
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
            'columns' => PhenophaseDuration::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new PhenophaseDurationTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
