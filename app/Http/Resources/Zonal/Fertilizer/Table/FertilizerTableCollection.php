<?php

namespace App\Http\Resources\Zonal\Fertilizer\Table;

use App\Models\Zonal\Fertilizer;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Zonal\Fertilizer\Table\FertilizerTableResource;

class FertilizerTableCollection extends ResourceCollection
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
            'columns' => Fertilizer::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FertilizerTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
