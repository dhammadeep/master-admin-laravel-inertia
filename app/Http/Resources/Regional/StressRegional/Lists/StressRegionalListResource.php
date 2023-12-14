<?php

namespace App\Http\Resources\Regional\StressRegional\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class StressRegionalListResource extends JsonResource
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
             'StateCode' => $this->StateCode,
             'StressID' => $this->StressID,
        ];
    }
}
