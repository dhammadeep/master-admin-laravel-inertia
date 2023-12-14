<?php

namespace App\Http\Resources\Regional\SeasonRegional\Lists;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Regional\SeasonRegional\SeasonRegionalDetailResource;

class SeasonRegionalListCollection extends ResourceCollection
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
            'data' => $this->collection->map(function ($data) {
                return new SeasonRegionalDetailResource($data);
            })->all()
        ];
    }
}
