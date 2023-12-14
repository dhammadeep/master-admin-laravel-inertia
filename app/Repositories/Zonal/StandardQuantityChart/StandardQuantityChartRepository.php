<?php

namespace App\Repositories\Zonal\StandardQuantityChart;

use Exception;
use App\Models\Zonal\StandardQuantityChart;
use App\Http\Requests\Zonal\StandardQuantityChart\StandardQuantityChartRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Zonal\StandardQuantityChart\RepoInterface\StandardQuantityChartRepoInterface;

class StandardQuantityChartRepository implements StandardQuantityChartRepoInterface
{
    /**
     * Find StandardQuantityCharts and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return StandardQuantityChart::query()
            ->select('ID',
            'ZonalVarietyID',
            'StandardQuantityPerAcre',
            'StandardPositiveVariancePerAcre',
            'StandardPositiveVariancePercent',
            'StandardNegativeVariancePerAcre',
            'StandardNegativeVariancePercent','Status')
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
                'VarietyZonal:ID,CommodityID,ZonalCommodityID,VarietyID,SowingWeekStart,SowingWeekEnd','VarietyZonal.ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
                'VarietyZonal.ZonalCommodity.Commodity:ID,Name',
                'VarietyZonal.ZonalCommodity.Acz:ID,Name,StateCode',
                'VarietyZonal.ZonalCommodity.Acz.State:ID,Name',
                'VarietyZonal.Variety:ID,Name'
                )
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
            return StandardQuantityChart::getTableFields();
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
            return StandardQuantityChart::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param StandardQuantityChartRequest $data
     *
     * @return Array
     */
    public function add(StandardQuantityChartRequest $data)
    {
        //Create a new entry in db
        try {
            StandardQuantityChart::create([
                'ZonalVarietyID' => $data->ZonalVarietyID,
                'StandardQuantityPerAcre' => $data->StandardQuantityPerAcre,
                'StandardPositiveVariancePerAcre' => $data->StandardPositiveVariancePerAcre,
                'StandardPositiveVariancePercent' => $data->StandardPositiveVariancePercent,
                'StandardNegativeVariancePerAcre' => $data->StandardNegativeVariancePerAcre,
                'StandardNegativeVariancePercent' => $data->StandardNegativeVariancePercent,
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
            return StandardQuantityChart::select('ID',
            'ZonalVarietyID',
            'StandardQuantityPerAcre',
            'StandardPositiveVariancePerAcre',
            'StandardPositiveVariancePercent',
            'StandardNegativeVariancePerAcre',
            'StandardNegativeVariancePercent')
            ->with(
                'VarietyZonal:ID,CommodityID,ZonalCommodityID,VarietyID,SowingWeekStart,SowingWeekEnd','VarietyZonal.ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
                'VarietyZonal.ZonalCommodity.Commodity:ID,Name',
                'VarietyZonal.ZonalCommodity.Acz:ID,Name,StateCode'
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
     * @param StandardQuantityChartRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StandardQuantityChartRequest $request, int $id)
    {
        try {
            $standardQuantityChart = StandardQuantityChart::find($id);
            $standardQuantityChart->ZonalVarietyID = $request->ZonalVarietyID;
            $standardQuantityChart->StandardQuantityPerAcre = $request->StandardQuantityPerAcre;
            $standardQuantityChart->StandardPositiveVariancePerAcre = $request->StandardPositiveVariancePerAcre;
            $standardQuantityChart->StandardPositiveVariancePercent = $request->StandardPositiveVariancePercent;
            $standardQuantityChart->StandardNegativeVariancePerAcre = $request->StandardNegativeVariancePerAcre;
            $standardQuantityChart->StandardNegativeVariancePercent = $request->StandardNegativeVariancePercent;

            $standardQuantityChart->save();
            return $standardQuantityChart;
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
            return StandardQuantityChart::whereIn("ID", $ids)
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
                return StandardQuantityChart::whereIn("ID", $ids)
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
                return StandardQuantityChart::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
