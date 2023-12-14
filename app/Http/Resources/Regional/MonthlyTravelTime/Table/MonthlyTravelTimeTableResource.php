<?php

namespace App\Http\Resources\Regional\MonthlyTravelTime\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyTravelTimeTableResource extends JsonResource
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
            'RegionName' => $this->Region->Name ?? '',
            'Month' => $this->MonthName ?? '',
            'UomName' => $this->Uom->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
