<?php

namespace App\Http\Resources\Zonal\PlantHealthIndex\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class PlantHealthIndexTableResource extends JsonResource
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
        if(isset($this->VarietyZonal->ZonalCommodity->Commodity)){
            $zonalCommodity = '<strong>Commodity: </strong>'.$this->VarietyZonal->ZonalCommodity->Commodity->Name." <br> ". '<strong>Sowing Week Start: </strong>'.$this->VarietyZonal->ZonalCommodity->SowingWeekStart." <br> ".'<strong>Sowing Week End: </strong>'.$this->VarietyZonal->ZonalCommodity->SowingWeekEnd;
        }

        $variety = '';
        if(isset($this->VarietyZonal->Variety)){
            $variety = '<strong>Vartiety: </strong>'.$this->VarietyZonal->Variety->Name." <br> ". '<strong>Sowing Week Start: </strong>'.$this->VarietyZonal->SowingWeekStart." <br> ".'<strong>Sowing Week End: </strong>'.$this->VarietyZonal->SowingWeekEnd;
        }

        return [
            'ID' => $this->ID,
            'StateName' => $this->VarietyZonal->ZonalCommodity->Acz->State->Name ?? '',
            'AczName' => $this->VarietyZonal->ZonalCommodity->Acz->Name ?? '',
            'ZonalCommodityName' => $zonalCommodity ?? '',
            'ZonalVarietyName' => $variety ?? '',
            'PhenophaseName' => $this->Phenophase->Name ?? '',
            'HealthParameterName' => $this->HealthParameter->Name ?? '',
            'Specifications' => $this->Specifications ?? '',
            'NormalValue' => $this->NormalValue ?? '',
            'IdealValue' => $this->IdealValue ?? '',
            'Status' => $this->Status,
        ];
    }
}
