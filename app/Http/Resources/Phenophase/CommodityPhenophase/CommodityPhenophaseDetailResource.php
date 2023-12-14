<?php

namespace App\Http\Resources\Phenophase\CommodityPhenophase;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityPhenophaseDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->PhenophaseID < 0) {
            log('ID cannot be 0');
        }
        return [
            'label' => $this->Phenophase->Name ?? '',
            'value' => $this->PhenophaseID,
        ];
    }
}
