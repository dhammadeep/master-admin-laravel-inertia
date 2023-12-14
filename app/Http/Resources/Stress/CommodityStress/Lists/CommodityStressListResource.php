<?php

namespace App\Http\Resources\Stress\CommodityStress\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityStressListResource extends JsonResource
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
        ];
    }
}
