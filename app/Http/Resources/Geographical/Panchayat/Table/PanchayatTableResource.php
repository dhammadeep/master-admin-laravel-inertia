<?php

namespace App\Http\Resources\Geographical\Panchayat\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class PanchayatTableResource extends JsonResource
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
            'StateName' => $this->State->Name ?? '',
            'DistrictName' => $this->District->Name ?? '',
            'TehsilName' => $this->Tehsil->Name ?? '',
            'PanchayatCode' => $this->PanchayatCode,
            'Status' => $this->Status,
        ];
    }
}
