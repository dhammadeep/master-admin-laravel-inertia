<?php

namespace App\Http\Resources\Zonal\VarietyZonal\Table;

use App\Models\Zonal\VarietyZonal;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\VarietyZonal\Table\VarietyZonalTableResource;

class VarietyZonalTableCollection extends ResourceCollection
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
            'columns' => VarietyZonal::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new VarietyZonalTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
