<?php

namespace App\Http\Resources\Agriculture\FarmMachinery\Table;

use App\Models\Agriculture\FarmMachinery;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\FarmMachinery\Table\FarmMachineryTableResource;

class FarmMachineryTableCollection extends ResourceCollection
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
            'columns' => FarmMachinery::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmMachineryTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
