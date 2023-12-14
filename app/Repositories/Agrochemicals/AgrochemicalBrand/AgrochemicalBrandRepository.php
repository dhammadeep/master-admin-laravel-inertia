<?php

namespace App\Repositories\Agrochemicals\AgrochemicalBrand;

use Exception;
use App\Models\Agrochemicals\AgrochemicalBrand;
use App\Http\Requests\Agrochemicals\AgrochemicalBrand\AgrochemicalBrandRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Agrochemicals\AgrochemicalBrand\RepoInterface\AgrochemicalBrandRepoInterface;

class AgrochemicalBrandRepository implements AgrochemicalBrandRepoInterface
{
    /**
     * Find AgrochemicalBrands and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return AgrochemicalBrand::query()
            ->select(
                'ID',
                'Name',
                'AgrochemicalID',
                'CompanyID',
                'AgrochemicalStatus',
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
            ->with('company:ID,Name','agrochemical:ID,Name,AgrochemicalTypeID')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all AgrochemicalBrands
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
         try {
           return AgrochemicalBrand::query()
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
            return AgrochemicalBrand::getTableFields();
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
            return AgrochemicalBrand::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param AgrochemicalBrandRequest $data
     *
     * @return Array
     */
    public function add(AgrochemicalBrandRequest $data)
    {
        try {
            AgrochemicalBrand::create([
                'Name' => $data->Name,
                'AgrochemicalID' => $data->AgrochemicalID,
                'CompanyID' => $data->CompanyID,
                'AgrochemicalStatus' => $data->AgrochemicalStatus,
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
            return AgrochemicalBrand::select('ID','Name','AgrochemicalID','CompanyID','AgrochemicalStatus')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param AgrochemicalBrandRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AgrochemicalBrandRequest $request, int $id)
    {
        try {
            $agrochemicalBrand = AgrochemicalBrand::find($id);
            $agrochemicalBrand->Name = $request->Name;
            $agrochemicalBrand->AgrochemicalID = $request->AgrochemicalID;
            $agrochemicalBrand->CompanyID = $request->CompanyID;
            $agrochemicalBrand->AgrochemicalStatus = $request->AgrochemicalStatus;
            $agrochemicalBrand->save();

            return $agrochemicalBrand;

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
            return AgrochemicalBrand::whereIn("ID", $ids)
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
            return AgrochemicalBrand::whereIn("ID", $ids)
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
            return AgrochemicalBrand::whereIn("ID", $ids)
                ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
