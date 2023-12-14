<?php

namespace App\Http\Resources\Commodity\CommodityPlantPart\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityPlantPartListResource extends JsonResource
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
             'CommodityID' => $this->CommodityID,
             'PhenophaseID' => $this->PhenophaseID,
             'PlantPartID' => $this->PlantPartID,
             'ImageID' => $this->ImageID,
             'FileUrl' => $this->FileUrl,
        ];
    }
}
