<?php

namespace App\Http\Resources\Farmer\FarmerGovtDepartment\Table;

use App\Models\Farmer\FarmerGovtDepartment;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerGovtDepartment\Table\FarmerGovtDepartmentTableResource;

class FarmerGovtDepartmentTableCollection extends ResourceCollection
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
            'columns' => FarmerGovtDepartment::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerGovtDepartmentTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
