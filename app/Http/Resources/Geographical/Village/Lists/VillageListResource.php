<?php

namespace App\Http\Resources\Geographical\Village\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class VillageListResource extends JsonResource
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
             'Name' => $this->Name,
             'StateCode' => $this->StateCode,
            'DistrictCode' => $this->DistrictCode,
            'TehsilCode' => $this->TehsilCode,
            'VillageCode' => $this->VillageCode,
        ];
    }
}
