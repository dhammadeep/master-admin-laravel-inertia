<?php

namespace App\Http\Resources\General\Bank\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class BankTableResource extends JsonResource
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
            'Name' => $this->Name ?? '',
            'BankCategoryName' => $this->BankCategory->Name ?? '',
            'Status' => $this->Status ?? '',
        ];
    }
}
