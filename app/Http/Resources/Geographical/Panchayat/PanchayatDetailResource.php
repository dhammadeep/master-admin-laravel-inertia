<?php

namespace App\Http\Resources\Geographical\Panchayat;

use Illuminate\Http\Resources\Json\JsonResource;

class PanchayatDetailResource extends JsonResource
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
        ];
    }
}
