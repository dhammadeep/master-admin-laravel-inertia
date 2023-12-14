<?php

namespace App\Http\Resources\Stress\SeedTreatment;

use Illuminate\Http\Resources\Json\JsonResource;

class SeedTreatmentDetailResource extends JsonResource
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
            'CommodityID' => $this->CommodityID,
            'VarietyID' => $this->VarietyID,
            'UomID' => $this->UomID,
            'Name' => $this->Name,
            'Dose' => $this->Dose,
        ];
    }
}
