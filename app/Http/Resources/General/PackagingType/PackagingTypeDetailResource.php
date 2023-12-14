<?php

namespace App\Http\Resources\General\PackagingType;

use Illuminate\Http\Resources\Json\JsonResource;

class PackagingTypeDetailResource extends JsonResource
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
            'Name' => $this->Name
        ];
    }
}
