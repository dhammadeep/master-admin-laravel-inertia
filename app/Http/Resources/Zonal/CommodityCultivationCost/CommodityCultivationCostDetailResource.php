<?php

namespace App\Http\Resources\Zonal\CommodityCultivationCost;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityCultivationCostDetailResource extends JsonResource
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
            'Status' => $this->Status
        ];
    }
}
