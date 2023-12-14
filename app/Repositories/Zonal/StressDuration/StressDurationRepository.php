<?php

namespace App\Repositories\Zonal\StressDuration;

use Exception;
use App\Models\Zonal\StressDuration;
use App\Http\Requests\Zonal\StressDuration\StressDurationRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Zonal\StressDuration\RepoInterface\StressDurationRepoInterface;

class StressDurationRepository implements StressDurationRepoInterface
{
    /**
     * Find StressDurations and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return StressDuration::query()
            ->select('ID','ZonalCommodityID','StressID','StartDas','EndDas','Status')
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
            ->with('ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
            'ZonalCommodity.Commodity:ID,Name',
            'ZonalCommodity.Acz:ID,Name,StateCode',
            'ZonalCommodity.Acz.State:ID,Name',
            'Stress:ID,StressTypeID,Name',
            'Stress.StressType:ID,Name')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());
        } catch (Exception $e) {
            dd($e);
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
            return StressDuration::getTableFields();
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
            return StressDuration::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param StressDurationRequest $data
     *
     * @return Array
     */
    public function add(StressDurationRequest $data)
    {
        //Create a new entry in db
        try {
            StressDuration::create([
                'ZonalCommodityID' => $data->ZonalCommodityID,
                'StressID' => $data->StressID,
                'StartDas' => $data->StartDas,
                'EndDas' => $data->EndDas
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
            return StressDuration::select('ID','ZonalCommodityID','StressID','StartDas','EndDas','Status')
            ->with('ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
            'ZonalCommodity.Commodity:ID,Name',
            'ZonalCommodity.Acz:ID,Name,StateCode',
            'ZonalCommodity.Acz.State:ID,Name',
            'Stress:ID,StressTypeID,Name')
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
     * @param StressDurationRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StressDurationRequest $request, int $id)
    {
        try {
            $stressDuration = StressDuration::find($id);
            $stressDuration->ZonalCommodityID = $request->ZonalCommodityID;
            $stressDuration->StressID = $request->StressID;
            $stressDuration->StartDas = $request->StartDas;
            $stressDuration->EndDas = $request->EndDas;
            $stressDuration->save();
            return $stressDuration;
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
            return StressDuration::whereIn("ID", $ids)
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
                return StressDuration::whereIn("ID", $ids)
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
                return StressDuration::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
