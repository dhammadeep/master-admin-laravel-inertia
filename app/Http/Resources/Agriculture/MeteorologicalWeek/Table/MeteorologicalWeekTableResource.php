<?php

namespace App\Http\Resources\Agriculture\MeteorologicalWeek\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class MeteorologicalWeekTableResource extends JsonResource
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
            'WeekNo' => $this->WeekNo,
            'StartDay' => $this->StartDate,
            'EndDay' => $this->EndDate,
            'Status' => $this->Status,
        ];
    }
}
