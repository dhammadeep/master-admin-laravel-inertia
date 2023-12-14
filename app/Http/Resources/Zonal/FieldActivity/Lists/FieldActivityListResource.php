<?php

namespace App\Http\Resources\Zonal\FieldActivity\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class FieldActivityListResource extends JsonResource
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
            'StateCode' => $this->ZonalCommodity->Acz->State->ID ?? '',
            'AczID' => $this->ZonalCommodity->Acz->ID ?? '',
            'ZonalCommodityID' => $this->ZonalCommodityID,
            'PhenophaseID' => $this->PhenophaseID,
            'Name' => $this->Name,
            'Description' => $this->Description,
            'ImageUrl' => $this->ImageUrl
        ];
    }
}
