<?php

namespace App\Http\Resources\General\ModeOfPayment\Table;

use App\Models\General\ModeOfPayment;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\General\ModeOfPayment\Table\ModeOfPaymentTableResource;

class ModeOfPaymentTableCollection extends ResourceCollection
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
            'columns' => ModeOfPayment::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new ModeOfPaymentTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
