<?php

namespace App\Http\Resources\Regional\SeasonRegional\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class SeasonRegionalTableResource extends JsonResource
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
            'StateName' => $this->State->Name ?? '',
            'SeasonName' => $this->Season->Name ?? '',
            'SeasonStartWeek' => $this->SeasonStartWeek,
            'SeasonEndWeek' => $this->SeasonEndWeek,
            'Status' => $this->Status,
        ];
    }
}
