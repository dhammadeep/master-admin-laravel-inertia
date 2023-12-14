<?php

namespace App\Http\Resources\Zonal\StandardQuantityChart;

use Illuminate\Http\Resources\Json\JsonResource;

class StandardQuantityChartDetailResource extends JsonResource
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
            'StateCode' => $this->StateCode ?? '',
            'AczID' => $this->VarietyZonal->ZonalCommodity->AczID ?? '',
            'ZonalCommodityID' => $this->VarietyZonal->ZonalCommodityID ?? '',
            'ZonalVarietyID' => $this->ZonalVarietyID,
            'StandardQuantityPerAcre' => $this->StandardQuantityPerAcre,
            'StandardPositiveVariancePerAcre' => $this->StandardPositiveVariancePerAcre,
            'StandardPositiveVariancePercent' => $this->StandardPositiveVariancePercent,
            'StandardNegativeVariancePerAcre' => $this->StandardNegativeVariancePerAcre,
            'StandardNegativeVariancePercent' => $this->StandardNegativeVariancePercent,
        ];
    }
}
