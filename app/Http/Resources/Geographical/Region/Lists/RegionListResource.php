<?php

namespace App\Http\Resources\Geographical\Region\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionListResource extends JsonResource
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
            'ID' => $this->RegionID,
            'RegionID' => $this->RegionID,
            'StateCode' => $this->StateCode,
            'Name' => $this->Name,
            'Description' => $this->Description
        ];
    }
}
