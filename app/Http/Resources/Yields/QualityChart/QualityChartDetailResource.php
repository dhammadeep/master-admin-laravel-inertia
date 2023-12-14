<?php

namespace App\Http\Resources\Yields\QualityChart;

use Illuminate\Http\Resources\Json\JsonResource;

class QualityChartDetailResource extends JsonResource
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
            'label' => $this->phenophase->Name ?? '',
            'value' => $this->PhenophaseID,
        ];
    }
}
