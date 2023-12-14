<?php

namespace App\Http\Resources\Agriculture\MeteorologicalWeek\Lists;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\MeteorologicalWeek\MeteorologicalWeekDetailResource;

class MeteorologicalWeekListCollection extends ResourceCollection
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
                return new MeteorologicalWeekDetailResource($data);
            })->all()
        ];
    }
}
