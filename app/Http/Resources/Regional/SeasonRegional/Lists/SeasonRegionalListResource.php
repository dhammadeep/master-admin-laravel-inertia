<?php

namespace App\Http\Resources\Regional\SeasonRegional\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class SeasonRegionalListResource extends JsonResource
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
            'SeasonID' => $this->SeasonID,
            'SeasonStartWeek' => $this->SeasonStartWeek,
            'SeasonEndWeek' => $this->SeasonEndWeek,
        ];
    }
}
