<?php

namespace App\Http\Resources\Agrochemicals\AgroCommoditychemical;

use Illuminate\Http\Resources\Json\JsonResource;

class AgroCommoditychemicalDetailResource extends JsonResource
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
            'Name' => $this->Name,
            'AgrochemicalID' => $this->AgrochemicalID,
            'AgrochemicalTypeID' => $this->AgrochemicalTypeID,
            'CIBRCApproved' => $this->CIBRCApproved,
            'WaitingPeriod' => $this->WaitingPeriod,
        ];
    }
}
