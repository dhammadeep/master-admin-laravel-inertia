<?php

namespace App\Http\Resources\Farmer\FarmOwnershipType\Table;

use App\Models\Farmer\FarmOwnershipType;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmOwnershipType\Table\FarmOwnershipTypeTableResource;

class FarmOwnershipTypeTableCollection extends ResourceCollection
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
            'columns' => FarmOwnershipType::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmOwnershipTypeTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
