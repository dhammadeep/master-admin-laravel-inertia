<?php

namespace App\Http\Resources\Zonal\ConduciveWeather\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class ConduciveWeatherTableResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this);
        $zonalCommodity = '';
        if(isset($this->ZonalCommodity->Commodity)){
            $zonalCommodity = '<strong>Commodity: </strong>'.$this->ZonalCommodity->Commodity->Name." <br> ". '<strong>Sowing Week Start: </strong>'.$this->ZonalCommodity->SowingWeekStart." <br> ".'<strong>Sowing Week End: </strong>'.$this->ZonalCommodity->SowingWeekEnd;
        }
         return [
            'ID' => $this->ID,
            'StateName' => $this->ZonalCommodity->Acz->State->Name ?? '',
            'AczName' => $this->ZonalCommodity->Acz->Name ?? '',
            'ZonalCommodityName' => $zonalCommodity ?? '',
            'StressTypeName' => $this->Stress->StressType->Name ?? '',
            'StressName' => $this->Stress->Name ?? '',
            'WeatherParameterName' => $this->WeatherParameter->Name ?? '',
            'Lower' => $this->Lower,
            'Upper' => $this->Upper,
            'ConduciveDuration' => $this->ConduciveDuration,
            'RelaxingDuration' => $this->RelaxingDuration,
            'Status' => $this->Status,
        ];
    }
}
