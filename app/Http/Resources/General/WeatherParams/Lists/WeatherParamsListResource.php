<?php

namespace App\Http\Resources\General\WeatherParams\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherParamsListResource extends JsonResource
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
             'Label' => $this->Label,
             'UnitID' => $this->UnitID,
        ];
    }
}
