<?php

namespace App\Http\Resources\Geographical\District\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictListResource extends JsonResource
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
             'StateCode' => $this->StateCode,
             'DistrictCode' => $this->DistrictCode,
             'Name' => $this->Name,
        ];
    }
}
