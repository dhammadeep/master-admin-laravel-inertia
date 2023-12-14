<?php

namespace App\Http\Resources\Geographical\Tehsil;

use Illuminate\Http\Resources\Json\JsonResource;

class TehsilDetailResource extends JsonResource
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
            'StateName' => $this->StateName,
            'DistrictName' => $this->DistrictName,
            'TehsilCode' => $this->TehsilCode,
            'Name' => $this->Name,
            'Status' => $this->Status,
        ];
    }
}
