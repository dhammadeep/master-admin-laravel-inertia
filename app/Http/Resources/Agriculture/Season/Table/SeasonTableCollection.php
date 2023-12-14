<?php

namespace App\Http\Resources\Agriculture\Season\Table;

use App\Models\Agriculture\Season;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\Season\Table\SeasonTableResource;

class SeasonTableCollection extends ResourceCollection
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
            'columns' => Season::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new SeasonTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
