<?php

namespace App\Http\Resources\Zonal\FavourableWeather\Table;

use App\Models\Zonal\FavourableWeather;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\FavourableWeather\Table\FavourableWeatherTableResource;

class FavourableWeatherTableCollection extends ResourceCollection
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
            'columns' => FavourableWeather::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FavourableWeatherTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
