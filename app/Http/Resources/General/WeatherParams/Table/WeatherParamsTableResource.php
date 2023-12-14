<?php

namespace App\Http\Resources\General\WeatherParams\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherParamsTableResource extends JsonResource
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
            'Label' => $this->Label,
            'UnitName' => $this->Unit->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
