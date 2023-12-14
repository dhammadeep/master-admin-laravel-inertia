<?php

namespace App\Http\Resources\Regional\CommodityRegional\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityRegionalTableResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $zontalCommodity = '';
        if(isset($this->ZonalCommodity->Commodity)){
            $zontalCommodity = '<strong>Commodity: </strong>'.$this->ZonalCommodity->Commodity->Name." <br> ". '<strong>Sowing Week Start: </strong>'.$this->ZonalCommodity->SowingWeekStart." <br> ".'<strong>Sowing Week End: </strong>'.$this->ZonalCommodity->SowingWeekEnd;
        }
         return [
            'ID' => $this->ID,
            'StateName' => $this->State->Name ?? '',
            'RegionName' => $this->Region->Name ?? '',
            'AczName' => $this->Acz->Name ?? '',
            'ZonalCommodityName' => $zontalCommodity,
            'HarvestRelaxation' => $this->HarvestRelaxation,
            'MaxRigtsInLot' => $this->MaxRigtsInLot,
            'MinLotSize' => $this->MinLotSize,
            'TargetValue' => $this->TargetValue,
            'Status' => $this->Status,
        ];
    }
}
