<?php

namespace App\Http\Resources\Regional\Terrain\Table;

use App\Models\Regional\Terrain;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Regional\Terrain\Table\TerrainTableResource;

class TerrainTableCollection extends ResourceCollection
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
            'columns' => Terrain::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new TerrainTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
