<?php

namespace App\Http\Resources\Farmer\FarmerIncomeSource\Table;

use App\Models\Farmer\FarmerIncomeSource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerIncomeSource\Table\FarmerIncomeSourceTableResource;

class FarmerIncomeSourceTableCollection extends ResourceCollection
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
            'columns' => FarmerIncomeSource::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerIncomeSourceTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
