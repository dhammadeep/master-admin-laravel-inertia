<?php

namespace App\Http\Resources\Agrochemicals\AgrochemicalBrand;

use Illuminate\Http\Resources\Json\JsonResource;

class AgrochemicalBrandDetailResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { dd($this);
        return [
            'ID' => $this->ID,
           'CompanyID' => $this->CompanyID,
            'Name' => $this->Name,
            'AgrochemicalStatus' => $this->AgrochemicalStatus,
            'Status' => $this->Status
        ];
    }
}
