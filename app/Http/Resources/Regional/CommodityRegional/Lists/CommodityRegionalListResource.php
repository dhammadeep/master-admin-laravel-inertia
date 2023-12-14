<?php

namespace App\Http\Resources\Regional\CommodityRegional\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityRegionalListResource extends JsonResource
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
            'StateCode' => $this->StateCode,
            'RegionID' => $this->RegionID,
            'AczId' => $this->AczId,
            'ZonalCommodityID' => $this->ZonalCommodityID,
            'HarvestRelaxation' => $this->HarvestRelaxation,
            'MaxRigtsInLot' => $this->MaxRigtsInLot,
            'MinLotSize' => $this->MinLotSize,
            'TargetValue' => $this->TargetValue,
        ];
    }
}
