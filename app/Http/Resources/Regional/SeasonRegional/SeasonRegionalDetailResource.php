<?php

namespace App\Http\Resources\Regional\SeasonRegional;

use Illuminate\Http\Resources\Json\JsonResource;

class SeasonRegionalDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->SeasonID < 0) {
            log('ID cannot be 0');
        }
        return [
            'label' => $this->Season->Name ?? '',
            'value' => $this->SeasonID,
        ];
    }
}
