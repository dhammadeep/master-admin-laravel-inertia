<?php

namespace App\Http\Resources\Zonal\FieldActivity\Table;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class FieldActivityTableResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $zonalCommodity = '';
        if(isset($this->ZonalCommodity->Commodity)){
            $zonalCommodity = '<strong>Commodity: </strong>'.$this->ZonalCommodity->Commodity->Name." <br> ". '<strong>Sowing Week Start: </strong>'.$this->ZonalCommodity->SowingWeekStart." <br> ".'<strong>Sowing Week End: </strong>'.$this->ZonalCommodity->SowingWeekEnd;
        }
        
         return [
            'ID' => $this->ID,
            'StateName' => $this->ZonalCommodity->Acz->State->Name ?? '',
            'AczName' => $this->ZonalCommodity->Acz->Name ?? '',
            'ZonalCommodityName' => $zonalCommodity ?? '',
            'PhenophaseName' => $this->Phenophase->Name ?? '',
            'Name' => $this->Name,
            'Description' => $this->Description,
            'ImageUrl' => Str::replace('images/', 'thumbnails/', $this->ImageUrl),
            'Status' => $this->Status,
        ];
    }
}
