<?php

namespace App\Http\Resources\General\Bank\Table;

use App\Models\General\Bank;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\General\Bank\Table\BankTableResource;

class BankTableCollection extends ResourceCollection
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
            'columns' => Bank::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new BankTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
