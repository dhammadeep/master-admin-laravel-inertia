<?php

namespace App\Http\Resources\Zonal\Fertilizer;

use Illuminate\Http\Resources\Json\JsonResource;

class FertilizerDetailResource extends JsonResource
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
            'ZonalCommodityID' => $this->ZonalCommodityID,
            'DoseFactorID' => $this->DoseFactorID,
            'Name' => $this->Name,
            'UomID' => $this->UomID,
            'Dose' => $this->Dose,
            'Note' => $this->Note,
        ];
    }
}
