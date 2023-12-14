<?php

namespace App\Http\Resources\Agriculture\SourceOfWater\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class SourceOfWaterListResource extends JsonResource
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
