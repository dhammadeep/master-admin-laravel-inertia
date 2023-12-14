<?php

namespace App\Http\Resources\Stress\CommodityStressStage\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityStressStageTableResource extends JsonResource
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
            'StageName' => $this->stage->Name ?? '',
            'Description' => $this->Description,
            'PhenophaseStartName' => $this->phenophaseStart->Name ?? '',
            'PhenophaseEndName' => $this->phenophaseEnd->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
