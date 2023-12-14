<?php

namespace App\Http\Resources\Yields\Health\Table;

use App\Models\Yields\Health;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Yields\Health\Table\HealthTableResource;

class HealthTableCollection extends ResourceCollection
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
            'columns' => Health::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new HealthTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
