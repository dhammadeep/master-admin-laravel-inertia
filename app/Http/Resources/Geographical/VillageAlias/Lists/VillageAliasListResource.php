<?php

namespace App\Http\Resources\Geographical\VillageAlias\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class VillageAliasListResource extends JsonResource
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
            'StateCode' => $this->StateCode,
            'DistrictCode' => $this->DistrictCode,
            'TehsilCode' => $this->TehsilCode,
            'VillageCode' => $this->VillageCode,
            'Alias' => $this->Alias,
            'Status' => $this->Status,
        ];
    }
}
