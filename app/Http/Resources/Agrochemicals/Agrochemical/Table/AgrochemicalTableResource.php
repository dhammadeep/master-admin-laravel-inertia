<?php

namespace App\Http\Resources\Agrochemicals\Agrochemical\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class AgrochemicalTableResource extends JsonResource
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
            'Name' => $this->Name ?? '',
            'AgrochemicalTypeName' => $this->agrochemicalType->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
