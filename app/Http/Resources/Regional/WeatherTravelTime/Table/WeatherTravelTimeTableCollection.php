<?php

namespace App\Http\Resources\Regional\WeatherTravelTime\Table;

use App\Models\Regional\WeatherTravelTime;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Regional\WeatherTravelTime\Table\WeatherTravelTimeTableResource;

class WeatherTravelTimeTableCollection extends ResourceCollection
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
            'columns' => WeatherTravelTime::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new WeatherTravelTimeTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
