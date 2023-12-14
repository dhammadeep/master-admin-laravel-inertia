<?php

namespace App\Http\Resources\Commodity\QualityCommodityParameter\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class QualityCommodityParameterListResource extends JsonResource
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
             'CommodityID' => $this->CommodityID,
             'ParameterID' => $this->ParameterID
        ];
    }
}
