<?php

namespace App\Http\Resources\Phenophase\CommodityPhenophase\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityPhenophaseTableResource extends JsonResource
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
            'CommodityName' => $this->commodity->Name ?? '',
            'PhenophaseName' => $this->phenophase->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
