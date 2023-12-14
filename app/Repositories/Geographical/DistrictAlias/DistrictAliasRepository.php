<?php

namespace App\Repositories\Geographical\DistrictAlias;

use Exception;
use App\Models\Geographical\DistrictAlias;
use App\Http\Requests\Geographical\DistrictAlias\DistrictAliasRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Geographical\DistrictAlias\RepoInterface\DistrictAliasRepoInterface;

class DistrictAliasRepository implements DistrictAliasRepoInterface
{
    /**
     * Find DistrictAliases and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return DistrictAlias::query()
            ->select('ID','Alias','DistrictCode','StateCode','Status')
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
            ->with('State:ID,Name','District:ID,Name')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());
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
            return DistrictAlias::getTableFields();
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
            return DistrictAlias::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param DistrictAliasRequest $data
     *
     * @return Array
     */
    public function add(DistrictAliasRequest $data)
    {
        //Create a new entry in db
        try {
            DistrictAlias::create([
                'StateCode' => $data->StateCode,
                'DistrictCode' => $data->DistrictCode,
                'Alias' => $data->Alias
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
           return DistrictAlias::select('ID','Alias','DistrictCode','StateCode')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
           throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param DistrictAliasRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DistrictAliasRequest $request, int $id)
    {
        try {
            $districtAlias = DistrictAlias::find($id);
            $districtAlias->StateCode = $request->StateCode;
            $districtAlias->DistrictCode = $request->DistrictCode;
            $districtAlias->Alias = $request->Alias;
            $districtAlias->save();

            return $districtAlias;
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
            return DistrictAlias::whereIn("ID", $ids)
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
                return DistrictAlias::whereIn("ID", $ids)
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
                return DistrictAlias::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
