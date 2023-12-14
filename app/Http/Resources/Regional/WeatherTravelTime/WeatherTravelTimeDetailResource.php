<?php

namespace App\Http\Resources\Regional\WeatherTravelTime;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherTravelTimeDetailResource extends JsonResource
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
            'Name' => $this->Name,
            'MinPerKm' => $this->MinPerKm,
        ];
    }
}
