<?php

namespace App\Http\Resources\Regional\BankRegional\Table;

use App\Models\Regional\BankRegional;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Regional\BankRegional\Table\BankRegionalTableResource;

class BankRegionalTableCollection extends ResourceCollection
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
            'columns' => BankRegional::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new BankRegionalTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
