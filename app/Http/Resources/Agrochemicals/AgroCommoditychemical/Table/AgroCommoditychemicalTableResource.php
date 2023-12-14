<?php

namespace App\Http\Resources\Agrochemicals\AgroCommoditychemical\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class AgroCommoditychemicalTableResource extends JsonResource
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
            'CommodityName' => $this->commodity->Name ?? '',
            'AgrochemicalName' => $this->agrochemical->Name ?? '',
            'AgrochemicalTypeName' => $this->agrochemicalType->Name ?? '',
            'CIBRCApproved' => $this->CIBRCApproved,
            'WaitingPeriod' => $this->WaitingPeriod,
            'ErrorMessage' => $this->ErrorMessage,
            'Status' => $this->Status,
        ];
    }
}
