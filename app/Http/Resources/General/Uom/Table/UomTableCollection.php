<?php

namespace App\Http\Resources\General\Uom\Table;

use App\Models\General\Uom;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\General\Uom\Table\UomTableResource;

class UomTableCollection extends ResourceCollection
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
            'columns' => Uom::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new UomTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
