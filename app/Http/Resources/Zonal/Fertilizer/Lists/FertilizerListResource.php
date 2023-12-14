<?php

namespace App\Http\Resources\Zonal\Fertilizer\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class FertilizerListResource extends JsonResource
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
            'StateCode' => $this->ZonalCommodity->Acz->State->ID ?? '',
            'AczID' => $this->ZonalCommodity->Acz->ID ?? '',
            'ZonalCommodityID' => $this->ZonalCommodityID,
            'DoseFactorID' => $this->DoseFactorID,
            'Name' => $this->Name,
            'UomID' => $this->UomID,
            'Dose' => $this->Dose,
            'Note' => $this->Note,
        ];
    }
}
