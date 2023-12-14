<?php

namespace App\Http\Resources\Agriculture\SeedSource\Table;

use App\Models\Agriculture\SeedSource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\SeedSource\Table\SeedSourceTableResource;

class SeedSourceTableCollection extends ResourceCollection
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
            'columns' => SeedSource::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new SeedSourceTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
