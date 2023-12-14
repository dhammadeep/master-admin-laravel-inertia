<?php

namespace App\Http\Resources\Zonal\ConduciveWeather\Table;

use App\Models\Zonal\ConduciveWeather;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\ConduciveWeather\Table\ConduciveWeatherTableResource;

class ConduciveWeatherTableCollection extends ResourceCollection
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
            'columns' => ConduciveWeather::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new ConduciveWeatherTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
