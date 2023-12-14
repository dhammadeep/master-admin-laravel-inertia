<?php

namespace App\Repositories\Agrochemicals\Agrochemical;

use Exception;
use App\Models\Agrochemicals\Agrochemical;
use App\Http\Requests\Agrochemicals\Agrochemical\AgrochemicalRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Agrochemicals\Agrochemical\RepoInterface\AgrochemicalRepoInterface;

class AgrochemicalRepository implements AgrochemicalRepoInterface
{
    /**
     * Find Agrochemicals and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return Agrochemical::query()
            ->select(
                'ID',
                'Name',
                'AgrochemicalTypeID',
                'Status'
            )
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
            ->with('agrochemicalType:ID,Name')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all Agrochemicals
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
         try {
           return Agrochemical::query()
            ->select(
                'ID',
                'Name'
            )
            ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                $query->where($on, '=', "{$search}");
            })
            ->orderBy('Name', 'asc')
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
            return Agrochemical::getTableFields();
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
            return Agrochemical::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param AgrochemicalRequest $data
     *
     * @return Array
     */
    public function add(AgrochemicalRequest $data)
    {
        //Create a new entry in db
        try {
            Agrochemical::create([
                'Name' => $data->Name,
                'AgrochemicalTypeID' => $data->AgrochemicalTypeID,
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
        return Agrochemical::select('ID','Name','AgrochemicalTypeID')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param AgrochemicalRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AgrochemicalRequest $request, int $id)
    {
        try {
            $agrochemical = Agrochemical::find($id);
            $agrochemical->Name = $request->Name;
            $agrochemical->AgrochemicalTypeID = $request->AgrochemicalTypeID;
            $agrochemical->save();

            return $agrochemical;

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
            return Agrochemical::whereIn("ID", $ids)
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
            return Agrochemical::whereIn("ID", $ids)
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
            return Agrochemical::whereIn("ID", $ids)
                ->update(['Status' => 'Approved']);
        })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
