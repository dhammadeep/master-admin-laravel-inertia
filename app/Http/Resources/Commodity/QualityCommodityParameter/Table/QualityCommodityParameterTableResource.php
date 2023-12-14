<?php

namespace App\Http\Resources\Commodity\QualityCommodityParameter\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class QualityCommodityParameterTableResource extends JsonResource
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
            'ParameterID' => $this->ParameterID,
            'Status' => $this->Status,
        ];
    }
}
