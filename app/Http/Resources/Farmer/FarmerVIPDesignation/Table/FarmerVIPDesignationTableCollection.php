<?php

namespace App\Http\Resources\Farmer\FarmerVIPDesignation\Table;

use App\Models\Farmer\FarmerVIPDesignation;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerVIPDesignation\Table\FarmerVIPDesignationTableResource;

class FarmerVIPDesignationTableCollection extends ResourceCollection
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
            'columns' => FarmerVIPDesignation::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerVIPDesignationTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
