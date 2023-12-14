<?php

namespace App\Repositories\Regional\RegionalConnectivity;

use Exception;
use App\Models\Regional\RegionalConnectivity;
use App\Http\Requests\Regional\RegionalConnectivity\RegionalConnectivityRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Regional\RegionalConnectivity\RepoInterface\RegionalConnectivityRepoInterface;

class RegionalConnectivityRepository implements RegionalConnectivityRepoInterface
{
    /**
     * Find RegionalConnectivities and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return RegionalConnectivity::query()
            ->select(
                'ID',
                'RegionID',
                'SurfacedProportion',
                'UnsurfacedProportion',
                'SurfacedTimeMinPerkm',
                'UnsurfacedTimeMinPerKm',
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
            ->with('Region:RegionID,StateCode,Name','Region.State:ID,Name')
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
            return RegionalConnectivity::getTableFields();
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
            return RegionalConnectivity::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param RegionalConnectivityRequest $data
     *
     * @return Array
     */
    public function add(RegionalConnectivityRequest $data)
    {
        //Create a new entry in db
        try {
            RegionalConnectivity::create([
                'RegionID' => $data->RegionID,
                'SurfacedProportion' => $data->SurfacedProportion,
                'UnsurfacedProportion' => $data->UnsurfacedProportion,
                'SurfacedTimeMinPerkm' => $data->SurfacedTimeMinPerkm,
                'UnsurfacedTimeMinPerKm' => $data->UnsurfacedTimeMinPerKm,
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
            return RegionalConnectivity::
            select(
                'ID',
                'RegionID',
                'SurfacedProportion',
                'UnsurfacedProportion',
                'SurfacedTimeMinPerkm',
                'UnsurfacedTimeMinPerKm'
            )
            ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param RegionalConnectivityRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RegionalConnectivityRequest $request, int $id)
    {
        try {
            $regionalConnectivity = RegionalConnectivity::find($id);
            $regionalConnectivity->RegionID = $request->RegionID;
            $regionalConnectivity->SurfacedProportion = $request->SurfacedProportion;
            $regionalConnectivity->UnsurfacedProportion = $request->UnsurfacedProportion;
            $regionalConnectivity->SurfacedTimeMinPerkm = $request->SurfacedTimeMinPerkm;
            $regionalConnectivity->UnsurfacedTimeMinPerKm = $request->UnsurfacedTimeMinPerKm;
            $regionalConnectivity->save();
            return $regionalConnectivity;
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
            return RegionalConnectivity::whereIn("ID", $ids)
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
                return RegionalConnectivity::whereIn("ID", $ids)
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
                return RegionalConnectivity::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
