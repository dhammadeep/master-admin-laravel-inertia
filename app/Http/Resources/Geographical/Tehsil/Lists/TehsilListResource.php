<?php

namespace App\Http\Resources\Geographical\Tehsil\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class TehsilListResource extends JsonResource
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
            'Name' => $this->Name,
            'Status' => $this->Status,
        ];
    }
}
