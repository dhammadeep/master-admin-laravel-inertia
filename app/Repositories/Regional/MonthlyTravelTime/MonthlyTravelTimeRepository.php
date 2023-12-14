<?php

namespace App\Repositories\Regional\MonthlyTravelTime;

use Exception;
use App\Models\Regional\MonthlyTravelTime;
use App\Http\Requests\Regional\MonthlyTravelTime\MonthlyTravelTimeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Regional\MonthlyTravelTime\RepoInterface\MonthlyTravelTimeRepoInterface;

class MonthlyTravelTimeRepository implements MonthlyTravelTimeRepoInterface
{
    /**
     * Find MonthlyTravelTimes and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return MonthlyTravelTime::query()
            ->select('ID','RegionID','Month','UnitType','Status')
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
            ->with('Region:RegionID,Name','Uom:ID,Name')
            ->orderBy('ID', 'desc')->paginate($rowsPerPage)
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
            return MonthlyTravelTime::getTableFields();
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
            return MonthlyTravelTime::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param MonthlyTravelTimeRequest $data
     *
     * @return Array
     */
    public function add(MonthlyTravelTimeRequest $data)
    {
        //Create a new entry in db
        try {
            MonthlyTravelTime::create([
                'RegionID' => $data->RegionID,
                'Month' => $data->Month,
                'UnitType' => $data->UnitType

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
            return MonthlyTravelTime::select('ID','RegionID','Month','UnitType')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param MonthlyTravelTimeRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MonthlyTravelTimeRequest $request, int $id)
    {
        try {
            $monthlyTravelTime = MonthlyTravelTime::find($id);
            $monthlyTravelTime->RegionID = $request->RegionID;
            $monthlyTravelTime->Month = $request->Month;
            $monthlyTravelTime->UnitType = $request->UnitType;
            $monthlyTravelTime->save();
            return $monthlyTravelTime;
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
            return MonthlyTravelTime::whereIn("ID", $ids)
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
                return MonthlyTravelTime::whereIn("ID", $ids)
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
                return MonthlyTravelTime::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
