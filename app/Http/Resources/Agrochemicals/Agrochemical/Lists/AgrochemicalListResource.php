<?php

namespace App\Http\Resources\Agrochemicals\Agrochemical\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class AgrochemicalListResource extends JsonResource
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
             'AgrochemicalTypeID' => $this->AgrochemicalTypeID,
             'Status' => $this->Status,
        ];
    }
}
