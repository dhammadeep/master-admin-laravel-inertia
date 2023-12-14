<?php

namespace App\Http\Resources\Agrochemicals\AgrochemicalType;

use Illuminate\Http\Resources\Json\JsonResource;

class AgrochemicalTypeDetailResource extends JsonResource
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
        ];
    }
}
