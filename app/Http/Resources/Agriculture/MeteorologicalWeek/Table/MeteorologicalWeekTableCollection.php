<?php

namespace App\Http\Resources\Agriculture\MeteorologicalWeek\Table;

use App\Models\Agriculture\MeteorologicalWeek;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\MeteorologicalWeek\Table\MeteorologicalWeekTableResource;

class MeteorologicalWeekTableCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'columns' => MeteorologicalWeek::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new MeteorologicalWeekTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
