<?php

namespace App\Http\Resources\Yields\Health;

use Illuminate\Http\Resources\Json\JsonResource;

class HealthDetailResource extends JsonResource
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
