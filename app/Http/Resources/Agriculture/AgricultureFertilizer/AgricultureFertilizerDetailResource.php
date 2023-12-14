<?php

namespace App\Http\Resources\Agriculture\AgricultureFertilizer;

use Illuminate\Http\Resources\Json\JsonResource;

class AgricultureFertilizerDetailResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->ID < 0) {
            log('ID cannot be 0');
        }
        return [
            'label' => $this->Name,
            'value' => $this->Name,
        ];
    }
}
