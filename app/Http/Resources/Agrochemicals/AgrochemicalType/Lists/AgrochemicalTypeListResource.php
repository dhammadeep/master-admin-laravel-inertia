<?php

namespace App\Http\Resources\Agrochemicals\AgrochemicalType\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class AgrochemicalTypeListResource extends JsonResource
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
        ];
    }
}
