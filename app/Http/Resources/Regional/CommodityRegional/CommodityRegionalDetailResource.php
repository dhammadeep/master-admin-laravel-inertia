<?php

namespace App\Http\Resources\Regional\CommodityRegional;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityRegionalDetailResource extends JsonResource
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
