<?php

namespace App\Http\Resources\Commodity\CommodityPlantPart\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityPlantPartTableResource extends JsonResource
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
            'CommodityName' => $this->Commodity->Name,
            'PhenophaseName' => $this->Phenophase->Name,
            'PlantPartName' => $this->PlantPart->Name,
            'FileUrl' => $this->FileUrl,
            'Status' => $this->Status
        ];
    }
}
