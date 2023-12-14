<?php

namespace App\Http\Resources\Farmer\LanguageFarmer;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageFarmerDetailResource extends JsonResource
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
