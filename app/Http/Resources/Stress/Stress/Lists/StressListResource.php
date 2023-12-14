<?php

namespace App\Http\Resources\Stress\Stress\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class StressListResource extends JsonResource
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
            'StressTypeID' => $this->StressTypeID
        ];
    }
}
