<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomExport implements FromCollection, WithHeadings
{
    private  $isSample, $model;
    use Exportable;
    public function __construct($isSample, $model)
    {
        $this->isSample = $isSample;
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->isSample == false) {
            $columns = $this->model::getTableFields();
            $fields = collect($columns)->map(function (array $field) {
                return $field['name'];
            })->all();
            return $this->model::select($fields)->get();
        }
        return collect([]);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        $columns = $this->model::getTableFields();
        $fields = array_map(function ($field) {
            return $field['name'];
        }, $columns);

        $fields = array_values(array_diff($fields, ['Status']));
        
        return $fields;
    }
}
