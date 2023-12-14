<?php

namespace App\Http\Resources\Regional\RegionalConnectivity\Table;

use App\Models\Regional\RegionalConnectivity;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Regional\RegionalConnectivity\Table\RegionalConnectivityTableResource;

class RegionalConnectivityTableCollection extends ResourceCollection
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
            'columns' => RegionalConnectivity::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new RegionalConnectivityTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
