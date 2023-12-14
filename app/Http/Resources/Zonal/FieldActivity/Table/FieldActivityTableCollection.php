<?php

namespace App\Http\Resources\Zonal\FieldActivity\Table;

use App\Models\Zonal\FieldActivity;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\FieldActivity\Table\FieldActivityTableResource;

class FieldActivityTableCollection extends ResourceCollection
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
            'columns' => FieldActivity::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FieldActivityTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
