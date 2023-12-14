<?php

namespace App\Http\Resources\Zonal\ZonalCommodity\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class ZonalCommodityListResource extends JsonResource
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
             'StateCode' => $this->Acz->StateCode ?? '',
             'AczID' => $this->AczID  ?? '',
             'CommodityID' => $this->CommodityID  ?? '',
             'SowingWeekStart' => $this->SowingWeekStart  ?? '',
             'SowingWeekEnd' => $this->SowingWeekEnd  ?? '',
             'HarvestWeekStart' => $this->HarvestWeekStart  ?? '',
             'HarvestWeekEnd' => $this->HarvestWeekEnd  ?? '',
             'NoOfDaysForHarvestMonitoring' => $this->NoOfDaysForHarvestMonitoring
        ];
    }
}
