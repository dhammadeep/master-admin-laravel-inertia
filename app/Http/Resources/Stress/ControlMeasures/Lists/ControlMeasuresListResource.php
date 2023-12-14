<?php

namespace App\Http\Resources\Stress\ControlMeasures\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class ControlMeasuresListResource extends JsonResource
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
