<?php

namespace App\Http\Resources\Stress\AgrochemicalApplication\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class AgrochemicalApplicationTableResource extends JsonResource
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
            'Status' => $this->Status,
        ];
    }
}
