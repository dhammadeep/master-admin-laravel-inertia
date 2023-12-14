<?php

namespace App\Http\Resources\Zonal\StressDuration;

use Illuminate\Http\Resources\Json\JsonResource;

class StressDurationDetailResource extends JsonResource
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
            'StateCode' => $this->ZonalCommodity->Acz->StateCode ?? '',
            'AczID' => $this->ZonalCommodity->AczID ?? '',
            'ZonalCommodityID' => $this->ZonalCommodityID ?? '',
            'StressTypeID' => $this->Stress->StressTypeID ?? '',
            'StressID' => $this->StressID ?? '',
            'StartDas' => $this->StartDas ?? '',
        ];
    }
}
