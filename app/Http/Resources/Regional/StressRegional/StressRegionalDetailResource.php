<?php

namespace App\Http\Resources\Regional\StressRegional;

use Illuminate\Http\Resources\Json\JsonResource;

class StressRegionalDetailResource extends JsonResource
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
            'StateCode' => $this->StateCode,
            'StressID' => $this->StressID,
        ];
    }
}
