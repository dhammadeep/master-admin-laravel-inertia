<?php

namespace App\Repositories\Zonal\VarietyZonal;

use Exception;
use App\Models\Zonal\VarietyZonal;
use App\Http\Requests\Zonal\VarietyZonal\VarietyZonalRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Zonal\VarietyZonal\RepoInterface\VarietyZonalRepoInterface;

class VarietyZonalRepository implements VarietyZonalRepoInterface
{
    /**
     * Find VarietyZonals and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return VarietyZonal::query()
            ->select(
            'ID',
            'AczID',
            'CommodityID',
            'ZonalCommodityID',
            'VarietyID',
            'SowingWeekStart',
            'SowingWeekEnd',
            'HarvestWeekStart',
            'HarvestWeekEnd',
            'NoOfDaysForHarvestMonitoring',
            'Status')
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
            ->with(
            'ZonalCommodity:ID,AczID',
            'Commodity:ID,Name',
            'ZonalCommodity.Acz:ID,Name,StateCode',
            'ZonalCommodity.Acz.State:ID,Name',
            'Variety:ID,Name')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());
        } catch (Exception $e) {
            dd($e);
            throw $e;
        }
    }

    /**
     * Find all VarietyZonal as per condition for dropdown listing
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return VarietyZonal::query()
                ->select('ID', 'VarietyID')
                ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                    $query->where($on, '=', "{$search}");
                })
                ->with('Variety:ID,Name')
                ->orderBy('VarietyID', 'asc')
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
            return VarietyZonal::getTableFields();
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
            return VarietyZonal::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param VarietyZonalRequest $data
     *
     * @return Array
     */
    public function add(VarietyZonalRequest $data)
    {
        //Create a new entry in db
        try {
            VarietyZonal::create([
                'Name' => $data->Name,
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
            return VarietyZonal::select('ID','Name')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param VarietyZonalRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VarietyZonalRequest $request, int $id)
    {
        try {
            $varietyZonal = VarietyZonal::find($id);
            $varietyZonal->Name = $request->Name;
            $varietyZonal->save();
            return $varietyZonal;
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
            return VarietyZonal::whereIn("ID", $ids)
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
                return VarietyZonal::whereIn("ID", $ids)
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
                return VarietyZonal::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
