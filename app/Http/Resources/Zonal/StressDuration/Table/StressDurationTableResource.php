<?php

namespace App\Http\Resources\Zonal\StressDuration\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class StressDurationTableResource extends JsonResource
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
        if(isset($this->ZonalCommodity->Commodity)){
            $zonalCommodity = '<strong>Commodity: </strong>'.$this->ZonalCommodity->Commodity->Name." <br> ". '<strong>Sowing Week Start: </strong>'.$this->ZonalCommodity->SowingWeekStart." <br> ".'<strong>Sowing Week End: </strong>'.$this->ZonalCommodity->SowingWeekEnd;
        }

        return [
            'ID' => $this->ID,
            'StateName' => $this->ZonalCommodity->Acz->State->Name ?? '',
            'AczName' => $this->ZonalCommodity->Acz->Name ?? '',
            'ZonalCommodityName' => $zonalCommodity ?? '',
            'StressTypeName' => $this->Stress->StressType->Name ?? '',
            'StressName' => $this->Stress->Name ?? '',
            'StartDas' => $this->StartDas ?? '',
            'EndDas' => $this->EndDas ?? '',
            'Status' => $this->Status,
        ];
    }
}
