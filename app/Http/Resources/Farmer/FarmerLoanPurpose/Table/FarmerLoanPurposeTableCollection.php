<?php

namespace App\Http\Resources\Farmer\FarmerLoanPurpose\Table;

use App\Models\Farmer\FarmerLoanPurpose;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerLoanPurpose\Table\FarmerLoanPurposeTableResource;

class FarmerLoanPurposeTableCollection extends ResourceCollection
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
            'columns' => FarmerLoanPurpose::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerLoanPurposeTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
