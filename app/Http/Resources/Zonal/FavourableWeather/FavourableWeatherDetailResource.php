<?php

namespace App\Http\Resources\Zonal\FavourableWeather;

use Illuminate\Http\Resources\Json\JsonResource;

class FavourableWeatherDetailResource extends JsonResource
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
            'ID' => $this->ID,
            'ZonalCommodityID' => $this->ZonalCommodityID,
            'PhenophaseID' => $this->PhenophaseID,
            'WeatherParameterID' => $this->WeatherParameterID,
            'SpecificationAverage' => $this->SpecificationAverage,
            'SpecificationLower' => $this->SpecificationLower,
            'SpecificationUpper' => $this->SpecificationUpper,
        ];
    }
}
