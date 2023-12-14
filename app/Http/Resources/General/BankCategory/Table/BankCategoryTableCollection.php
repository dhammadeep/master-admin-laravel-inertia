<?php

namespace App\Http\Resources\General\BankCategory\Table;

use App\Models\General\BankCategory;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\General\BankCategory\Table\BankCategoryTableResource;

class BankCategoryTableCollection extends ResourceCollection
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
            'columns' => BankCategory::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new BankCategoryTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
