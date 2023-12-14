<?php

namespace App\Http\Resources\Zonal\StressControl\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class StressControlListResource extends JsonResource
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
            'StateCode' => $this->ZonalCommodity->Acz->State->ID ?? '',
            'AczID' => $this->ZonalCommodity->Acz->ID ?? '',
            'ZonalCommodityID' => $this->ZonalCommodityID,
            'StressControlMeasureID' => $this->StressControlMeasureID,
            'StressID' => $this->StressID,
            'RecomendationID' => $this->RecomendationID,
            'AgrochemicalInstructionID' => $this->AgrochemicalInstructionID,
            'AgrochemApplicationTypeID' => $this->AgrochemApplicationTypeID,
            'AgrochemicalID' => $this->AgrochemicalID,
            'DosePerAcre' => $this->DosePerAcre,
            'PerAcreUomID' => $this->PerAcreUomID,
            'WaterPerAcre' => $this->WaterPerAcre,
            'PerAcreWaterUomID' => $this->PerAcreWaterUomID,
            'DosePerLitre' => $this->DosePerLitre,
        ];
    }
}
