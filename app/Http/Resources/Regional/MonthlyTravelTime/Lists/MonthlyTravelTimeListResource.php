<?php

namespace App\Http\Resources\Regional\MonthlyTravelTime\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyTravelTimeListResource extends JsonResource
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
             'RegionID' => $this->RegionID,
             'Month' => $this->Month,
             'UnitType' => $this->UnitType,
        ];
    }
}
