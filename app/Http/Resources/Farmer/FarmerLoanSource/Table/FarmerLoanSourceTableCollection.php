<?php

namespace App\Http\Resources\Farmer\FarmerLoanSource\Table;

use App\Models\Farmer\FarmerLoanSource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerLoanSource\Table\FarmerLoanSourceTableResource;

class FarmerLoanSourceTableCollection extends ResourceCollection
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
            'columns' => FarmerLoanSource::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerLoanSourceTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
