<?php

namespace App\Http\Resources\Geographical\Village\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class VillageTableResource extends JsonResource
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
            'VillageCode' => $this->VillageCode,
            'Name' => $this->Name,
            'Status' => $this->Status,
        ];
    }
}
