<?php

namespace App\Http\Resources\Geographical\Panchayat\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class PanchayatListResource extends JsonResource
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
            'StateCode' => $this->StateCode,
            'DistrictCode' => $this->DistrictCode,
            'TehsilCode' => $this->TehsilCode,
            'PanchayatCode' => $this->PanchayatCode,
            'Status' => $this->Status,
        ];
    }
}
