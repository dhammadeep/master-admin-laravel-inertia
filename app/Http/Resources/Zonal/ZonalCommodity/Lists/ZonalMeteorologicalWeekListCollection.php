<?php

namespace App\Http\Resources\Zonal\ZonalCommodity\Lists;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ZonalMeteorologicalWeekListCollection extends ResourceCollection
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
            'data' => $this->collection->map(function ($data) {
                dd($data);
                return [
                    'label' => $data->Name,
                    'value' => $data->ID,
                ];
            })->all()
        ];
    }
}
