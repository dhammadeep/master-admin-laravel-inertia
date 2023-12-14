<?php

namespace App\Http\Resources\Agrochemicals\AgrochemicalBrand\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class AgrochemicalBrandTableResource extends JsonResource
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
            'AgrochemicalName' => $this->agrochemical->Name ?? '',
            'CompanyName' => $this->company->Name ?? '',
            'AgrochemicalStatus' => $this->AgrochemicalStatus,
            'Status' => $this->Status
        ];
    }
}
