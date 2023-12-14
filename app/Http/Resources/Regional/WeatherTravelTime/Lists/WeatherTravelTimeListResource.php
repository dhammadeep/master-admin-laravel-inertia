<?php

namespace App\Http\Resources\Regional\WeatherTravelTime\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherTravelTimeListResource extends JsonResource
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
             'Name' => $this->Name,
             'MinPerKm' => $this->MinPerKm,
        ];
    }
}
