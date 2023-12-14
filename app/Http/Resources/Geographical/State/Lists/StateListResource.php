<?php

namespace App\Http\Resources\Geographical\State\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class StateListResource extends JsonResource
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
             'CountryCode' => $this->CountryCode,
             'StateCode' => $this->StateCode,
             'Name' => $this->Name,
        ];
    }
}
