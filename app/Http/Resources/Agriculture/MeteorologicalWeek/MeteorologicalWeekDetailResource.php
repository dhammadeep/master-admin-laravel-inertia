<?php

namespace App\Http\Resources\Agriculture\MeteorologicalWeek;

use Illuminate\Http\Resources\Json\JsonResource;

class MeteorologicalWeekDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->ID < 0) {
            log('ID cannot be 0');
        }
        return [
            'label' => $this->WeekNo,
            'value' => $this->ID,
        ];
    }
}
