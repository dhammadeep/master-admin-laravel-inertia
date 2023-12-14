<?php

namespace App\Http\Resources\General\PoiType\Table;

use App\Models\General\PoiType;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\General\PoiType\Table\PoiTypeTableResource;

class PoiTypeTableCollection extends ResourceCollection
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
            'columns' => PoiType::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new PoiTypeTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
