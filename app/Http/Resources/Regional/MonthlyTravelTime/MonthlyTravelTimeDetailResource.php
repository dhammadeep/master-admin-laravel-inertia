<?php

namespace App\Http\Resources\Regional\MonthlyTravelTime;

use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyTravelTimeDetailResource extends JsonResource
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
            'RegionID' => $this->RegionID,
            'Month' => $this->Month,
            'UnitType' => $this->UnitType,
        ];
    }
}
