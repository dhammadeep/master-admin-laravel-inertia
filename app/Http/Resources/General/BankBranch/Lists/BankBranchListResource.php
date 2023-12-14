<?php

namespace App\Http\Resources\General\BankBranch\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class BankBranchListResource extends JsonResource
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
             'Name' => $this->Name,
             'DistrictCode' => $this->DistrictCode,
             'BankID' => $this->BankID,
             'IFSCCode' => $this->IFSCCode,
        ];
    }
}
