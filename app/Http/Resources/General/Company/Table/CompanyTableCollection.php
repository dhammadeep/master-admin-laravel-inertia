<?php

namespace App\Http\Resources\General\Company\Table;

use App\Models\General\Company;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\General\Company\Table\CompanyTableResource;

class CompanyTableCollection extends ResourceCollection
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
            'columns' => Company::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new CompanyTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
