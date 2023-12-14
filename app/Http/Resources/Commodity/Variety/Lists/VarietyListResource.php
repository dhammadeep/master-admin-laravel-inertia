<?php

namespace App\Http\Resources\Commodity\Variety\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class VarietyListResource extends JsonResource
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
             'CommodityID' => $this->CommodityID,
             'HsCodeID' => $this->HsCodeID,
             'DomesticRestrictions' => $this->DomesticRestrictions,
             'InternationalRestrictions' => $this->InternationalRestrictions,
             'Name' => $this->Name,
             'VarietyCode' => $this->VarietyCode,
             'ParentVarietyID' => $this->ParentVarietyID
        ];
    }
}
