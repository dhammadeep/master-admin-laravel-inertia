<?php

namespace App\Http\Resources\Stress\Stage;

use Illuminate\Http\Resources\Json\JsonResource;

class StageDetailResource extends JsonResource
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
            'Name' => $this->Name,
            'Description' => $this->Description
        ];
    }
}
