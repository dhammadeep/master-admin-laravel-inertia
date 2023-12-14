<?php

namespace App\Http\Resources\Zonal\StandardQuantityChart\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class StandardQuantityChartTableResource extends JsonResource
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
            'StandardQuantityPerAcre' => $this->StandardQuantityPerAcre,
            'StandardPositiveVariancePerAcre' => $this->StandardPositiveVariancePerAcre,
            'StandardPositiveVariancePercent' => $this->StandardPositiveVariancePercent,
            'StandardNegativeVariancePerAcre' => $this->StandardNegativeVariancePerAcre,
            'StandardNegativeVariancePercent' => $this->StandardNegativeVariancePercent,
            'Status' => $this->Status,
        ];
    }
}
