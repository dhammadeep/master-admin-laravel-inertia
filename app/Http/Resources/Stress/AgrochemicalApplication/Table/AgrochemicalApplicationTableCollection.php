<?php

namespace App\Http\Resources\Stress\AgrochemicalApplication\Table;

use App\Models\Stress\AgrochemicalApplication;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\AgrochemicalApplication\Table\AgrochemicalApplicationTableResource;

class AgrochemicalApplicationTableCollection extends ResourceCollection
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
            'columns' => AgrochemicalApplication::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new AgrochemicalApplicationTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
