<?php

namespace App\Http\Resources\Geographical\Tehsil\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class TehsilTableResource extends JsonResource
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
            'TehsilCode' => $this->TehsilCode,
            'Name' => $this->Name,
            'Status' => $this->Status,
        ];
    }
}
