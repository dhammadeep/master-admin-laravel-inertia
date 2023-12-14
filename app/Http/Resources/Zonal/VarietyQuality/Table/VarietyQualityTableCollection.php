<?php

namespace App\Http\Resources\Zonal\VarietyQuality\Table;

use App\Models\Zonal\VarietyQuality;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\VarietyQuality\Table\VarietyQualityTableResource;

class VarietyQualityTableCollection extends ResourceCollection
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
            'columns' => VarietyQuality::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new VarietyQualityTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
