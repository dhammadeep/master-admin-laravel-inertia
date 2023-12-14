<?php

namespace App\Http\Resources\Geographical\Region\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionTableResource extends JsonResource
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
            'StateName' => $this->State->Name ?? '',
            'Name' => $this->Name,
            'Description' => $this->Description
        ];
    }
}
