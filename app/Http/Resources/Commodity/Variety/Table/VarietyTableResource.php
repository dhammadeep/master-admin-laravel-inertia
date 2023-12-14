<?php

namespace App\Http\Resources\Commodity\Variety\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class VarietyTableResource extends JsonResource
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
            'ID' => $this->ID ?? '',
            'CommodityName' => $this->Commodity->Name ?? '',
            'HsCodeName' => $this->HsnCode->HSCode ?? '',
            'DomesticRestrictions' => $this->DomesticRestrictions ?? '',
            'InternationalRestrictions' => $this->InternationalRestrictions ?? '',
            'ParentVarietyName' => $this->Variety->Name ?? '',
            'Name' => $this->Name ?? '',
            'VarietyCode' => $this->VarietyCode ?? '',
            'Status' => $this->Status ?? ''
        ];
    }
}
