<?php

namespace App\Http\Resources\Zonal\PhenophaseDuration\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class PhenophaseDurationTableResource extends JsonResource
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
        if(isset($this->VarietyZonal->ZonalCommodity->Commodity)){
            $zonalCommodity = '<strong>Commodity: </strong>'.$this->VarietyZonal->ZonalCommodity->Commodity->Name." <br> ". '<strong>Sowing Week Start: </strong>'.$this->VarietyZonal->ZonalCommodity->SowingWeekStart." <br> ".'<strong>Sowing Week End: </strong>'.$this->VarietyZonal->ZonalCommodity->SowingWeekEnd;
        }

        $variety = '';
        if(isset($this->VarietyZonal->Variety)){
            $variety = '<strong>Vartiety: </strong>'.$this->VarietyZonal->Variety->Name." <br> ". '<strong>Sowing Week Start: </strong>'.$this->VarietyZonal->SowingWeekStart." <br> ".'<strong>Sowing Week End: </strong>'.$this->VarietyZonal->SowingWeekEnd;
        }

        return [
            'ID' => $this->ID,
            'StateName' => $this->State->Name ?? '',
            'AczName' => $this->VarietyZonal->ZonalCommodity->Acz->Name ?? '',
            'ZonalCommodityName' => $zonalCommodity ?? '',
            'PhenophaseName' => $this->Phenophase->Name ?? '',
            'ZonalVarietyName' => $variety ?? '',
            'StartDas' => $this->StartDas,
            'EndDas' => $this->EndDas,
            'PhenophaseOrder' => $this->PhenophaseOrder,
            'Status' => $this->Status,
        ];
    }
}
