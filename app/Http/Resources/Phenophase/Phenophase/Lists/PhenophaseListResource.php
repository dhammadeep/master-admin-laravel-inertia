<?php

namespace App\Http\Resources\Phenophase\Phenophase\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class PhenophaseListResource extends JsonResource
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
