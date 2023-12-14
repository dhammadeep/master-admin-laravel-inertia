<?php

namespace App\Http\Resources\Geographical\Region;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionDetailResource extends JsonResource
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
            'label' => $this->Name,
            'value' => $this->RegionID,
        ];

        /*return [
            'ID' => $this->ID,
            'RegionID' => $this->RegionID,
            'StateCode' => $this->StateCode,
            'Name' => $this->Name,
            'Description' => $this->Description
        ];*/
    }
}
