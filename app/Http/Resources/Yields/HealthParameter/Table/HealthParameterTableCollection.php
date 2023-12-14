<?php

namespace App\Http\Resources\Yields\HealthParameter\Table;

use App\Models\Yields\HealthParameter;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Yields\HealthParameter\Table\HealthParameterTableResource;

class HealthParameterTableCollection extends ResourceCollection
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
            'columns' => HealthParameter::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new HealthParameterTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
