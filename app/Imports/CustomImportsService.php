<?php

namespace App\Imports;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class CustomImportsService implements ToModel, WithValidation, WithHeadingRow, WithBatchInserts, SkipsEmptyRows
{
    use Importable;
    public $data;
    private $model, $validation;

    public function __construct(Model $model, array $validation=[])
    {
        $this->data = collect();
        $this->model = $model;
        $this->validation = $validation;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $result = collect();
        //undot each element if it cantain dot
        $row = collect($row)->undot();

        //loop for each record
        $row = collect($row)->map(function ($item, $key) use ($result) {
            // fetch data for relationship column
            if(is_array($item)){
                $modelName =  collect($item)->keys()->first();
                $fieldName =  collect($item[$modelName])->keys()->first();
                $fieldValue =  $item[$modelName][$fieldName];
                //fetch id from Name of relaionship column
                $data =  $this->model->with("$modelName:ID,$fieldName")
                        ->whereHas($modelName, function($q) use($fieldName,$fieldValue) {
                            $q->where($fieldName,$fieldValue);
                        })
                        ->first();
                return $result[$key] = $data->$modelName->ID;
            }
            return $result[$key] = $item;
        })->all();

        return new $this->model($row);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return $this->validation;
    }
}
