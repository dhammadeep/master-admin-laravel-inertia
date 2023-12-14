<?php

namespace App\Http\Resources\Commodity\HSNCode\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class HSNCodeTableResource extends JsonResource
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
            'CommodityName' => $this->Commodity->Name ?? '',
            'CommodityClassName' => $this->CommodityClass->Name,
            'GeneralCommodityName' => $this->GeneralCommodity->Name,
            'HSCode' => $this->HSCode,
            'UomName' => $this->Uom->Name,
            'Description' => $this->Description,
            'Status' => $this->Status,
        ];
    }
}
