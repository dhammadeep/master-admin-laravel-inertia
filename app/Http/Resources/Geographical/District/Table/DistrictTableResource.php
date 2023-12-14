<?php

namespace App\Http\Resources\geographical\District\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictTableResource extends JsonResource
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
            'DistrictCode' => $this->DistrictCode,
            'Name' => $this->Name,
            'Status' => $this->Status,
        ];
    }
}
