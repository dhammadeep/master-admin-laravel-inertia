<?php

namespace App\Http\Resources\Test\Demo\Table;

use App\Models\Test\Demo;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Test\Demo\Table\DemoTableResource;

class DemoTableCollection extends ResourceCollection
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
            'columns' => Demo::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new DemoTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
