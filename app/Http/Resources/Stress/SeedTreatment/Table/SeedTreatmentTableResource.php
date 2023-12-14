<?php

namespace App\Http\Resources\Stress\SeedTreatment\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class SeedTreatmentTableResource extends JsonResource
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
            'CommodityName' => $this->commodity->Name ?? '',
            'VarietyName' => $this->variety->Name ?? '',
            'UomName' => $this->uom->Name ?? '',
            'Name' => $this->Name,
            'Dose' => $this->Dose,
            'Status' => $this->Status,
        ];
    }
}
