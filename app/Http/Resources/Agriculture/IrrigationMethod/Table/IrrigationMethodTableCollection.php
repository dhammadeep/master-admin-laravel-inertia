<?php

namespace App\Http\Resources\Agriculture\IrrigationMethod\Table;

use App\Models\Agriculture\IrrigationMethod;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\IrrigationMethod\Table\IrrigationMethodTableResource;

class IrrigationMethodTableCollection extends ResourceCollection
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
            'columns' => IrrigationMethod::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new IrrigationMethodTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
