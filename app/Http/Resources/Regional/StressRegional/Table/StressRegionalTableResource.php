<?php

namespace App\Http\Resources\Regional\StressRegional\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class StressRegionalTableResource extends JsonResource
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
            'StateName' => $this->State->Name ?? '',
            'StressName' => $this->Stress->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
