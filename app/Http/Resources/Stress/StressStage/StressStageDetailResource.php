<?php

namespace App\Http\Resources\Stress\StressStage;

use Illuminate\Http\Resources\Json\JsonResource;

class StressStageDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->stage->ID < 0) {
            log('ID cannot be 0');
        }
        return [
            'label' => $this->stage->Name ?? '',
            'value' => $this->stage->ID,
        ];
    }
}
