<?php

namespace App\Http\Resources\Zonal\CommodityCultivationCost\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityCultivationCostListResource extends JsonResource
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
            'CostOfCultivation' => $this->CostOfCultivation,
            'CostOfProduction' => $this->CostOfProduction,
            'StateCode' => $this->ZonalCommodity->Acz->StateCode ?? '',
            'AczID' => $this->ZonalCommodity->AczID ?? '',
            'Status' => $this->Status
        ];
    }
}
