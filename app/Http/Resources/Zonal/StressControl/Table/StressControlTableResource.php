<?php

namespace App\Http\Resources\Zonal\StressControl\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class StressControlTableResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $zonalCommodity = '';
        if(isset($this->ZonalCommodity->Commodity)){
            $zonalCommodity = '<strong>Commodity: </strong>'.$this->ZonalCommodity->Commodity->Name." <br> ". '<strong>Sowing Week Start: </strong>'.$this->ZonalCommodity->SowingWeekStart." <br> ".'<strong>Sowing Week End: </strong>'.$this->ZonalCommodity->SowingWeekEnd;
        }

         return [
            'ID' => $this->ID,
            'StateName' => $this->ZonalCommodity->Acz->State->Name ?? '',
            'AczName' => $this->ZonalCommodity->Acz->Name ?? '',
            'ZonalCommodityName' => $zonalCommodity ?? '',
            'StressControlMeasureName' => $this->ControlMeasure->Name ?? '',
            'StressName' => $this->Stress->Name ?? '',
            'RecomendationName' => $this->Recomendation->Name ?? '',
            'AgrochemicalInstructionName' => $this->AgrochemicalInstruction->Name ?? '',
            'AgrochemApplicationTypeName' => $this->AgrochemApplicationType->Name ?? '',
            'AgrochemicalName' => $this->ZonalCommodity->AgroCommoditychemical->Agrochemical->Name ?? '',
            'DosePerAcre' => $this->DosePerAcre ?? '',
            'PerAcreUomName'=> $this->PerAcreUom->Name ?? '',
            'WaterPerAcre' => $this->WaterPerAcre ?? '',
            'PerAcreWaterUomName'=> $this->PerAcreWaterUom->Name ?? '',
            'DosePerLitre' => $this->DosePerAcre ?? '',
            'Status' => $this->Status,
        ];
    }
}
