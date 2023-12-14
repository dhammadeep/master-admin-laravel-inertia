<?php

namespace App\Http\Resources\General\BankBranch\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class BankBranchTableResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return [
            'ID' => $this->ID,
            'Name' => $this->Name,
            'BankName' => $this->Bank->Name ?? '',
            'DistrictName' => $this->District->Name ?? '',
            'IFSCCode' => $this->IFSCCode,
            'Status' => $this->Status,
        ];
    }
}
