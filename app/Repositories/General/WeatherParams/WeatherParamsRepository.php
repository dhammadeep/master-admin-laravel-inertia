<?php

namespace App\Repositories\General\WeatherParams;

use Exception;
use App\Models\General\WeatherParams;
use App\Http\Requests\General\WeatherParams\WeatherParamsRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\General\WeatherParams\RepoInterface\WeatherParamsRepoInterface;

class WeatherParamsRepository implements WeatherParamsRepoInterface
{
    /**
     * Find WeatherParams and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return WeatherParams::query()
            ->select('ID','Name','Label','UnitID','Status')
            ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                $query->where($on, 'like', "%{$search}%");
            })
            ->when(count(explode(".", $on)) > 1, function ($query) use ($on, $search) {
                $on = explode(".", $on);
                $model = $on[0];
                $on = $on[1];
                $query->whereHas($model, function ($query2) use ($on, $search) {
                    $query2->where($on, 'like', "%{$search}%");
                });
            })
             ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all weather params with comoodity
     * @param string $on The field to search
     * @param string $search The value to search
     */
    public function all(string $on = null, string $search = null)
    {
         try {
           return WeatherParams::query()
           ->select('ID','Name')
            ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                $query->where($on, '=', "{$search}");
            })
            ->orderBy('ID', 'asc')
            ->get();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the list of table columns for the data table
     *
     * @return array
     */
    public function getTableFields(): array
    {
        try {
            return WeatherParams::getTableFields();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the list of form elements for the form builder
     *
     * @return array
     */
    public function getFormFields(): array
    {
        try {
            return WeatherParams::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param WeatherParamsRequest $data
     *
     * @return Array
     */
    public function add(WeatherParamsRequest $data)
    {
        //Create a new entry in db
        try {
            WeatherParams::create([
                'Name' => $data->Name,
                'Label' => $data->Label,
                'UnitID' => $data->UnitID,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find record by ID
     * @param int $id
     */
    public function findById(int $id)
    {
        try {
            return WeatherParams::select('ID','Name','Label','UnitID')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param WeatherParamsRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WeatherParamsRequest $request, int $id)
    {
        try {
            $weatherParams = WeatherParams::find($id);
            $weatherParams->Name = $request->Name;
            $weatherParams->Label = $request->Label;
            $weatherParams->UnitID = $request->UnitID;
            $weatherParams->save();
            return $weatherParams;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the list of ids from request
     *
     * @return array
     */
    public function updateStatusReject(array $id)
    {
        try {
            $idcollection = collect($id);

            $idcollection->map(function (array $ids) {
            return WeatherParams::whereIn("ID", $ids)
                ->update(['Status' => 'Rejected']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Get the list of ids from request
     *
     * @return array
     */
    public function updateStatusFinalize(array $id)
    {
        try {
            $idcollection = collect($id);

                $idcollection->map(function (array $ids) {
                return WeatherParams::whereIn("ID", $ids)
                    ->update(['Status' => 'Active']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the list of ids from request
     *
     * @return array
     */
    public function updateStatusApprove(array $id)
    {
        try {
            $idcollection = collect($id);

            $idcollection->map(function (array $ids) {
            return WeatherParams::whereIn("ID", $ids)
                ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
