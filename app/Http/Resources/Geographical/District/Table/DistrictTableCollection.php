<?php

namespace App\Http\Resources\Geographical\District\Table;

use App\Models\Geographical\District;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Geographical\District\Table\DistrictTableResource;

class DistrictTableCollection extends ResourceCollection
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
            'columns' => District::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new DistrictTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
