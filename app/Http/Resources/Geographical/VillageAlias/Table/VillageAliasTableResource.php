<?php

namespace App\Http\Resources\Geographical\VillageAlias\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class VillageAliasTableResource extends JsonResource
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
            'StateName' => $this->State->Name ?? '',
            'DistrictName' => $this->District->Name ?? '',
            'TehsilName' => $this->Tehsil->Name ?? '',
            'VillageName' => $this->Village->Name ?? '',
            'Alias' => $this->Alias,
            'Status' => $this->Status,
        ];
    }
}
