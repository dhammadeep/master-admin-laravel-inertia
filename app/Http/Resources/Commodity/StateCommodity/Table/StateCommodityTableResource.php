<?php

namespace App\Http\Resources\Commodity\StateCommodity\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class StateCommodityTableResource extends JsonResource
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
            'StateName' => $this->State->Name,
            'CommodityName' => $this->Commodity->Name,
            'Status' => $this->Status
        ];
    }
}
