<?php

namespace App\Http\Resources\Regional\RegionalConnectivity\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionalConnectivityListResource extends JsonResource
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
            'StateCode' => $this->Region->StateCode,
            'SurfacedProportion' => $this->SurfacedProportion,
            'UnsurfacedProportion' => $this->UnsurfacedProportion,
            'SurfacedTimeMinPerkm' => $this->SurfacedTimeMinPerkm,
            'UnsurfacedTimeMinPerKm' => $this->UnsurfacedTimeMinPerKm,
        ];
    }
}
