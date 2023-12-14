<?php

namespace App\Http\Resources\Farmer\FarmerIdProof\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class FarmerIdProofListResource extends JsonResource
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
