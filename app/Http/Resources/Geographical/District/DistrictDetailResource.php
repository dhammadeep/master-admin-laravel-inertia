<?php

namespace App\Http\Resources\Geographical\District;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictDetailResource extends JsonResource
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
            'Name' => $this->Name
        ];
    }
}
