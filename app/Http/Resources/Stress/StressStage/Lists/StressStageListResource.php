<?php

namespace App\Http\Resources\Stress\StressStage\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class StressStageListResource extends JsonResource
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
            'StressID' => $this->StressID,
            'StageID' => $this->StageID,
        ];
    }
}
