<?php

namespace App\Http\Resources\Agrochemicals\AgroCommoditychemical\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class AgroCommoditychemicalListResource extends JsonResource
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
            'AgrochemicalTypeID' => $this->AgrochemicalTypeID,
            'CommodityID' => $this->CommodityID,
            'AgrochemicalID' => $this->AgrochemicalID,
            'CIBRCApproved' => $this->CIBRCApproved,
            'WaitingPeriod' => $this->WaitingPeriod,
            'Status' => $this->Status,
          
             
        ];
    }
}
