<?php

namespace App\Http\Resources\Regional\MonthlyTravelTime\Table;

use App\Models\Regional\MonthlyTravelTime;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Regional\MonthlyTravelTime\Table\MonthlyTravelTimeTableResource;

class MonthlyTravelTimeTableCollection extends ResourceCollection
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
            'columns' => MonthlyTravelTime::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new MonthlyTravelTimeTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
