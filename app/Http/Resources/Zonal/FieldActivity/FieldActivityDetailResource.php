<?php

namespace App\Http\Resources\Zonal\FieldActivity;

use Illuminate\Http\Resources\Json\JsonResource;

class FieldActivityDetailResource extends JsonResource
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
            'ZonalCommodityID' => $this->ZonalCommodityID,
            'PhenophaseID' => $this->PhenophaseID,
            'Name' => $this->Name,
            'Description' => $this->Description,
            'ImageUrl' => $this->ImageUrl
        ];
    }
}
