<?php

namespace App\Http\Resources\Geographical\Tehsil\Table;

use App\Models\Geographical\Tehsil;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Geographical\Tehsil\Table\TehsilTableResource;

class TehsilTableCollection extends ResourceCollection
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
            'columns' => Tehsil::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new TehsilTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
