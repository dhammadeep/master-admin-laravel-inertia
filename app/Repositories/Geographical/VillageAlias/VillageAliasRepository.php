<?php

namespace App\Repositories\Geographical\VillageAlias;

use Exception;
use App\Models\Geographical\VillageAlias;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Geographical\VillageAlias\VillageAliasRequest;
use App\Repositories\Geographical\VillageAlias\RepoInterface\VillageAliasRepoInterface;

class VillageAliasRepository implements VillageAliasRepoInterface
{
    /**
     * Find VillageAliases and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return VillageAlias::query()
            ->select('ID','StateCode','DistrictCode','TehsilCode','VillageCode','Alias','Status')
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
            ->with('State:ID,Name','District:ID,Name','Tehsil:ID,Name','Village:ID,Name')
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
            return VillageAlias::getTableFields();
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
            return VillageAlias::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param VillageAliasRequest $data
     *
     * @return Array
     */
    public function add(VillageAliasRequest $data)
    {
        //Create a new entry in db
        try {
            VillageAlias::create([
                'StateCode' => $data->StateCode,
                'DistrictCode' => $data->DistrictCode,
                'TehsilCode' => $data->TehsilCode,
                'VillageCode' => $data->VillageCode,
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
            return VillageAlias::select('ID','StateCode','DistrictCode','TehsilCode','VillageCode','Alias')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param VillageAliasRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VillageAliasRequest $request, int $id)
    {
        try {
            $villageAlias = VillageAlias::find($id);
            $villageAlias->StateCode = $request->StateCode;
            $villageAlias->DistrictCode = $request->DistrictCode;
            $villageAlias->TehsilCode = $request->TehsilCode;
            $villageAlias->VillageCode = $request->VillageCode;
            $villageAlias->Alias = $request->Alias;
            $villageAlias->save();

            return $villageAlias;

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
            return VillageAlias::whereIn("ID", $ids)
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
                return VillageAlias::whereIn("ID", $ids)
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
                return VillageAlias::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
