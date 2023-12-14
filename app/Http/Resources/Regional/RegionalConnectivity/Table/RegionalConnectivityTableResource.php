<?php

namespace App\Http\Resources\Regional\RegionalConnectivity\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionalConnectivityTableResource extends JsonResource
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
            'StateName' => $this->Region->State->Name ?? '',
            'RegionName' => $this->Region->Name ?? '',
            'SurfacedProportion' => $this->SurfacedProportion,
            'UnsurfacedProportion' => $this->UnsurfacedProportion,
            'SurfacedTimeMinPerkm' => $this->SurfacedTimeMinPerkm,
            'UnsurfacedTimeMinPerKm' => $this->UnsurfacedTimeMinPerKm,
            'Status' => $this->Status,
        ];
    }
}
