<?php

namespace App\Http\Resources\Stress\CommodityStressStage;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityStressStageDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->StressID < 0) {
            log('ID cannot be 0');
        }
        return [
            'label' => $this->Stress->Name ?? '',
            'value' => $this->StressID,
        ];
    }
}
