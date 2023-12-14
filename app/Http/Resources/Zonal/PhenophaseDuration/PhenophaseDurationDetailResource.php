<?php

namespace App\Http\Resources\Zonal\PhenophaseDuration;

use Illuminate\Http\Resources\Json\JsonResource;

class PhenophaseDurationDetailResource extends JsonResource
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
            'StateCode' => $this->StateCode ?? '',
            'AczID' => $this->VarietyZonal->ZonalCommodity->AczID ?? '',
            'ZonalCommodityID' => $this->VarietyZonal->ZonalCommodityID ?? '',
            'PhenophaseID' => $this->PhenophaseID ?? '',
            'ZonalVarietyID' => $this->ZonalVarietyID ?? '',
            'StartDas' => $this->StartDas,
            'EndDas' => $this->EndDas,
            'PhenophaseOrder' => $this->PhenophaseOrder,
        ];
    }
}
