<?php

namespace App\Http\Resources\Stress\Stress\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class StressTableResource extends JsonResource
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
            'Name' => $this->Name,
            'StressTypeName' => $this->stressType->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
