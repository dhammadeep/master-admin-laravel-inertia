<?php

namespace App\Http\Resources\Zonal\ConduciveWeather\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class ConduciveWeatherListResource extends JsonResource
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
            'StateCode' => $this->ZonalCommodity->Acz->State->ID ?? '',
            'AczID' => $this->ZonalCommodity->Acz->ID ?? '',
            'ZonalCommodityID' => $this->ZonalCommodityID,
            'StressID' => $this->StressID,
            'WeatherParameterID' => $this->WeatherParameterID,
            'Lower' => $this->Lower,
            'Upper' => $this->Upper,
            'ConduciveDuration' => $this->ConduciveDuration,
            'RelaxingDuration' => $this->RelaxingDuration
        ];
    }
}
