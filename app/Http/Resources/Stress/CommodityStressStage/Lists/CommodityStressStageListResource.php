<?php

namespace App\Http\Resources\Stress\CommodityStressStage\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityStressStageListResource extends JsonResource
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
            'StressID' => $this->StressID,
            'StageID' => $this->StageID,
            'Description' => $this->Description,
            'StartPhenophaseID' => $this->StartPhenophaseID,
            'EndPhenophaseID' => $this->EndPhenophaseID,
        ];
    }
}
