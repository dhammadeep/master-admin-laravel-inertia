<?php

namespace App\Http\Resources\Regional\RegionalConnectivity;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionalConnectivityDetailResource extends JsonResource
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
            'SurfacedProportion' => $this->SurfacedProportion,
            'UnsurfacedProportion' => $this->UnsurfacedProportion,
            'SurfacedTimeMinPerkm' => $this->SurfacedTimeMinPerkm,
            'UnsurfacedTimeMinPerKm' => $this->UnsurfacedTimeMinPerKm,
        ];
    }
}
