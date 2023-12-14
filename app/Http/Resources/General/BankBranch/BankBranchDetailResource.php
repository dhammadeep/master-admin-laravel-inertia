<?php

namespace App\Http\Resources\General\BankBranch;

use Illuminate\Http\Resources\Json\JsonResource;

class BankBranchDetailResource extends JsonResource
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
            'DistrictCode' => $this->DistrictCode,
            'BankID' => $this->BankID,
            'IFSCCode' => $this->IFSCCode,
        ];
    }
}
