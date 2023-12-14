<?php

namespace App\Http\Resources\Commodity\HSNCode\Table;

use App\Models\Commodity\HSNCode;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\HSNCode\Table\HSNCodeTableResource;

class HSNCodeTableCollection extends ResourceCollection
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
            'columns' => HSNCode::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new HSNCodeTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
