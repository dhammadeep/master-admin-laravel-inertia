<?php

namespace App\Http\Resources\Stress\StressSeverity\Table;

use App\Models\Stress\StressSeverity;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\StressSeverity\Table\StressSeverityTableResource;

class StressSeverityTableCollection extends ResourceCollection
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
            'columns' => StressSeverity::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StressSeverityTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
