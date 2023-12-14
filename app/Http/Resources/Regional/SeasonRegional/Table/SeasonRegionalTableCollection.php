<?php

namespace App\Http\Resources\Regional\SeasonRegional\Table;

use App\Models\Regional\SeasonRegional;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Regional\SeasonRegional\Table\SeasonRegionalTableResource;

class SeasonRegionalTableCollection extends ResourceCollection
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
            'columns' => SeasonRegional::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new SeasonRegionalTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
