<?php

namespace App\Repositories\Geographical\Village;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Geographical\Village;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Geographical\Village\VillageRequest;
use App\Repositories\Geographical\Village\RepoInterface\VillageRepoInterface;

class VillageRepository implements VillageRepoInterface
{
    /**
     * Find Villages and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return Village::query()
            ->select('ID','StateCode','DistrictCode','TehsilCode','VillageCode','Name','Status')
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
            ->with('State:ID,Name','District:ID,Name','Tehsil:ID,Name')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());

        } catch (Exception $e) {
            dd($e);
            throw $e;
        }
    }

    /**
     * Find all Villages
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
         try {
            return Village::query()
            ->select('ID','Name')
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
            return Village::getTableFields();
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
            return Village::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param VillageRequest $data
     *
     * @return Array
     */
    public function add(VillageRequest $data)
    {
        //Create a new entry in db
        try {
            Village::create([
                'StateCode' => $data->StateCode,
                'DistrictCode' => $data->DistrictCode,
                'TehsilCode' => $data->TehsilCode,
                'VillageCode' => $data->VillageCode,
                'Name' => $data->Name
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
        return Village::select('ID','StateCode','DistrictCode','TehsilCode','VillageCode','Name')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param VillageRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VillageRequest $request, int $id)
    {
        try {
            $village = Village::find($id);
            $village->Name = $request->Name;
            $village->StateCode = $request->StateCode;
            $village->DistrictCode = $request->DistrictCode;
            $village->TehsilCode = $request->TehsilCode;
            $village->VillageCode = $request->VillageCode;
            $village->save();
            return $village;

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
            return Village::whereIn("ID", $ids)
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
                return Village::whereIn("ID", $ids)
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
                return Village::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
