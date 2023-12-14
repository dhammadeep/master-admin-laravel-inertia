<?php

namespace App\Http\Resources\Stress\CommodityStress\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityStressTableResource extends JsonResource
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
            'StressName' => $this->stress->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
