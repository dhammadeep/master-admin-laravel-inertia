<?php

namespace App\Http\Resources\Agrochemicals\AgrochemicalBrand\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class AgrochemicalBrandListResource extends JsonResource
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
             'CompanyID' => $this->CompanyID,
             'AgrochemicalID' => $this->AgrochemicalID,
             'AgrochemicalTypeID' =>$this->agrochemical->AgrochemicalTypeID,
             'AgrochemicalStatus' => $this->AgrochemicalStatus,
        ];
    }
}
