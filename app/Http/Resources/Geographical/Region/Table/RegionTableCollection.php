<?php

namespace App\Http\Resources\Geographical\Region\Table;

use App\Models\Geographical\Region;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Geographical\Region\Table\RegionTableResource;

class RegionTableCollection extends ResourceCollection
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
            'columns' => Region::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new RegionTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
