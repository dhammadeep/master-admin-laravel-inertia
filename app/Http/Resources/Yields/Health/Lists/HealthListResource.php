<?php

namespace App\Http\Resources\Yields\Health\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class HealthListResource extends JsonResource
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
            'PhenophaseID' => $this->PhenophaseID,
            'HealthParameterID' => $this->HealthParameterID,
            'Specification' => $this->Specification
        ];
    }
}
