<?php

namespace App\Http\Resources\Zonal\Fertilizer\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class FertilizerTableResource extends JsonResource
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
            'DoseFactorName' => $this->DoseFactor->Name ?? '',
            'Name' => $this->Name,
            'UomName' => $this->Uom->Name ?? '',
            'Dose' => $this->Dose,
            'Note' => $this->Note,
            'Status' => $this->Status,
        ];
    }
}
