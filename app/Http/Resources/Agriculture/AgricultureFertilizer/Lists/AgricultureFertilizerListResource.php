<?php

namespace App\Http\Resources\Agriculture\AgricultureFertilizer\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class AgricultureFertilizerListResource extends JsonResource
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
