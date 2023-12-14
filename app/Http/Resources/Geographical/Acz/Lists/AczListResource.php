<?php

namespace App\Http\Resources\Geographical\Acz\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class AczListResource extends JsonResource
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
             'StateCode' => $this->StateCode,
        ];
    }
}
