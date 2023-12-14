<?php

namespace App\Http\Resources\General\Uom\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class UomListResource extends JsonResource
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
             'Name' => $this->Name,
             'Description' => $this->Description,
        ];
    }
}
