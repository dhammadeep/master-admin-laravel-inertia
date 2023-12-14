<?php

namespace App\Http\Resources\Phenophase\CommodityPhenophase\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityPhenophaseListResource extends JsonResource
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
            'PhenophaseID' => $this->PhenophaseID
        ];
    }
}
