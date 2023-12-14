<?php

namespace App\Http\Resources\Geographical\Acz\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class AczTableResource extends JsonResource
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
            'StateName' => $this->State->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
