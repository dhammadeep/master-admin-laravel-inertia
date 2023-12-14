<?php

namespace App\Repositories\Yields\QuantityLossChart;

use Exception;
use App\Models\Yields\QuantityLossChart;
use App\Http\Requests\Yields\QuantityLossChart\QuantityLossChartRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Yields\QuantityLossChart\RepoInterface\QuantityLossChartRepoInterface;

class QuantityLossChartRepository implements QuantityLossChartRepoInterface
{
    /**
     * Find QuantityLossCharts and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return QuantityLossChart::query()
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
                    'commodity:ID,Name',
                    'stress:ID,Name',
                    'phenophase:ID,Name',
                )
                ->select(
                    'ID',
                    'CommodityID',
                    'StressID',
                    'PhenophaseID',
                    'MinBandValue',
                    'MaxBandValue',
                    'MinQuantityCorrectionPercent',
                    'MaxQuantityCorrectionPercent',
                    'Status'
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
            return QuantityLossChart::getTableFields();
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
            return QuantityLossChart::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param QuantityLossChartRequest $data
     *
     * @return Array
     */
    public function add(QuantityLossChartRequest $data)
    {
        //Create a new entry in db
        try {
            QuantityLossChart::create([
                'CommodityID' => $data->CommodityID,
                'StressID' => $data->StressID,
                'PhenophaseID' => $data->PhenophaseID,
                'MinBandValue' => $data->MinBandValue,
                'MaxBandValue' => $data->MaxBandValue,
                'MinQuantityCorrectionPercent' => $data->MinQuantityCorrectionPercent,
                'MaxQuantityCorrectionPercent' => $data->MaxQuantityCorrectionPercent,
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
            return QuantityLossChart::select(
                'ID',
                'CommodityID',
                'StressID',
                'PhenophaseID',
                'MinBandValue',
                'MaxBandValue',
                'MinQuantityCorrectionPercent',
                'MaxQuantityCorrectionPercent',
            )->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param QuantityLossChartRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(QuantityLossChartRequest $request, int $id)
    {
        try {
            $quantityLossChart = QuantityLossChart::find($id);
            $quantityLossChart->CommodityID = $request->CommodityID;
            $quantityLossChart->StressID = $request->StressID;
            $quantityLossChart->PhenophaseID = $request->PhenophaseID;
            $quantityLossChart->MinBandValue = $request->MinBandValue;
            $quantityLossChart->MaxBandValue = $request->MaxBandValue;
            $quantityLossChart->MinQuantityCorrectionPercent = $request->MinQuantityCorrectionPercent;
            $quantityLossChart->MaxQuantityCorrectionPercent = $request->MaxQuantityCorrectionPercent;
            $quantityLossChart->save();
            return $quantityLossChart;
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
                return QuantityLossChart::whereIn("ID", $ids)
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
                return QuantityLossChart::whereIn("ID", $ids)
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
                return QuantityLossChart::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
