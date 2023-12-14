<?php

namespace App\Http\Resources\Zonal\ZonalCommodity;

use Illuminate\Http\Resources\Json\JsonResource;

class ZonalCommodityDetailResource extends JsonResource
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
            'label' => $this->commodity->Name." ( ". 'Sowing Week Start & End : '.$this->SowingWeekStart." - ".$this->SowingWeekEnd." ) ",
            'value' => $this->ID,
        ];
    }
}
