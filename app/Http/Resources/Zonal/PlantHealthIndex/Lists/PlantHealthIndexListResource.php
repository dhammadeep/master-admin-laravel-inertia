<?php

namespace App\Http\Resources\Zonal\PlantHealthIndex\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class PlantHealthIndexListResource extends JsonResource
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
            'StateCode' => $this->StateCode ?? '',
            'AczID' => $this->VarietyZonal->ZonalCommodity->AczID ?? '',
            'ZonalCommodityID' => $this->VarietyZonal->ZonalCommodityID ?? '',
            'ZonalVarietyID' => $this->ZonalVarietyID,
            'PhenophaseID' => $this->PhenophaseID,
            'HealthParameterID' => $this->HealthParameterID,
            'Specifications' => $this->Specifications,
            'NormalValue' => $this->NormalValue,
            'IdealValue' => $this->IdealValue
        ];
    }
}
