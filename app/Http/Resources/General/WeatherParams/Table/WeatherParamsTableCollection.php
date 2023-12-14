<?php

namespace App\Http\Resources\General\WeatherParams\Table;

use App\Models\General\WeatherParams;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\General\WeatherParams\Table\WeatherParamsTableResource;

class WeatherParamsTableCollection extends ResourceCollection
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
            'columns' => WeatherParams::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new WeatherParamsTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
