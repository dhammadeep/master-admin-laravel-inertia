<?php

namespace App\Http\Resources\Geographical\Village\Table;

use App\Models\Geographical\Village;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Geographical\Village\Table\VillageTableResource;

class VillageTableCollection extends ResourceCollection
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
            'columns' => Village::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new VillageTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
