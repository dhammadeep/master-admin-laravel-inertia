<?php

namespace App\Http\Resources\Stress\AgrochemicalApplication;

use Illuminate\Http\Resources\Json\JsonResource;

class AgrochemicalApplicationDetailResource extends JsonResource
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
