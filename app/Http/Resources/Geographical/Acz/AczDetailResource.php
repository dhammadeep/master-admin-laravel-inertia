<?php

namespace App\Http\Resources\Geographical\Acz;

use Illuminate\Http\Resources\Json\JsonResource;

class AczDetailResource extends JsonResource
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
            'StateCode' => $this->StateCode
        ];
    }
}
