<?php

namespace App\Http\Resources\General\PackagingType\Table;

use App\Models\General\PackagingType;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\General\PackagingType\Table\PackagingTypeTableResource;

class PackagingTypeTableCollection extends ResourceCollection
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
            'columns' => PackagingType::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new PackagingTypeTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
