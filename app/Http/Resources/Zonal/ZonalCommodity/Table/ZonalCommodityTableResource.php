<?php

namespace App\Http\Resources\Zonal\ZonalCommodity\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class ZonalCommodityTableResource extends JsonResource
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
            'StateName' => $this->Acz->State->Name ?? '',
            'AczName' => $this->Acz->Name ?? '',
            'CommodityName' => $this->Commodity->Name ?? '',
            'SowingWeekStart' => $this->SowingWeekStart,
            'SowingWeekEnd' => $this->SowingWeekEnd,
            'HarvestWeekStart' => $this->HarvestWeekStart,
            'HarvestWeekEnd' => $this->HarvestWeekEnd,
            'NoOfDaysForHarvestMonitoring' => $this->NoOfDaysForHarvestMonitoring,
            'Status' => $this->Status
        ];
    }
}
