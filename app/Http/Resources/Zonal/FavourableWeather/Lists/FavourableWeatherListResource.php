<?php

namespace App\Http\Resources\Zonal\FavourableWeather\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class FavourableWeatherListResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return [
            'ZonalCommodityID' => $this->ZonalCommodityID,
            'PhenophaseID' => $this->PhenophaseID,
            'WeatherParameterID' => $this->WeatherParameterID,
            'SpecificationAverage' => $this->SpecificationAverage,
            'SpecificationLower' => $this->SpecificationLower,
            'SpecificationUpper' => $this->SpecificationUpper,
        ];
    }
}
