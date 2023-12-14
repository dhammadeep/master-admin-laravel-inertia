<?php

namespace App\Http\Resources\Stress\StressStage\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class StressStageTableResource extends JsonResource
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
            'StressName' => $this->stress->Name ?? '',
            'StageName' => $this->stage->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
