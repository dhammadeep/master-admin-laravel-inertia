<?php

namespace App\Http\Resources\General\BankBranch\Table;

use App\Models\General\BankBranch;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\General\BankBranch\Table\BankBranchTableResource;

class BankBranchTableCollection extends ResourceCollection
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
            'columns' => BankBranch::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new BankBranchTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
