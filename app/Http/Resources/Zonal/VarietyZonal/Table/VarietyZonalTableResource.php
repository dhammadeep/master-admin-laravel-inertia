<?php

namespace App\Http\Resources\Zonal\VarietyZonal\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class VarietyZonalTableResource extends JsonResource
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
            'StateName' => $this->ZonalCommodity->Acz->State->Name ?? '',
            'AczName' => $this->ZonalCommodity->Acz->Name ?? '',
            'CommodityName' => $this->Commodity->Name ?? '',
            'VarietyName' => $this->Variety->Name ?? '',
            'SowingWeekStart' => $this->SowingWeekStart,
            'SowingWeekEnd' => $this->SowingWeekEnd,
            'HarvestWeekStart' => $this->HarvestWeekStart,
            'HarvestWeekEnd' => $this->HarvestWeekEnd,
            'Status' => $this->Status,
        ];
    }
}
