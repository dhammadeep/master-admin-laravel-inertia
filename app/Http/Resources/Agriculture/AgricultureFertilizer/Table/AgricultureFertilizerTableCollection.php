<?php

namespace App\Http\Resources\Agriculture\AgricultureFertilizer\Table;

use App\Models\Agriculture\AgricultureFertilizer;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\AgricultureFertilizer\Table\AgricultureFertilizerTableResource;

class AgricultureFertilizerTableCollection extends ResourceCollection
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
            'columns' => AgricultureFertilizer::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new AgricultureFertilizerTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
