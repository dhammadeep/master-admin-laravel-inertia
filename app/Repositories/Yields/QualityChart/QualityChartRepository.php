<?php

namespace App\Repositories\Yields\QualityChart;

use Exception;
use App\Models\Yields\QualityChart;
use App\Http\Requests\Yields\QualityChart\QualityChartRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Yields\QualityChart\RepoInterface\QualityChartRepoInterface;

class QualityChartRepository implements QualityChartRepoInterface
{
    /**
     * Find QualityCharts and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return QualityChart::query()
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
                    'phenophase:ID,Name',
                    'healthParameter:ID,Name'
                )
                ->select(
                    'ID',
                    'Name',
                    'CommodityID',
                    'PhenophaseID',
                    'HealthParameterID',
                    'GradeI',
                    'GradeII',
                    'GradeIII',
                    'MinGradeI',
                    'MaxGradeI',
                    'MinGradeII',
                    'MaxGradeII',
                    'MinGradeIII',
                    'MaxGradeIII',
                    'Status'
                )
                ->orderBy('id', 'desc')->paginate($rowsPerPage)
                ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all QualityChart as per condition for dropdown listing
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return QualityChart::query()
                ->select('ID', 'Name')
                ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                    $query->where($on, '=', "{$search}");
                })
                ->orderBy('PhenophaseID', 'asc')
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
            return QualityChart::getTableFields();
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
            return QualityChart::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Add a single record in the table
     *
     * @param QualityChartRequest $data
     *
     * @return Array
     */
    public function add(QualityChartRequest $data)
    {
        //Create a new entry in db
        try {
            QualityChart::create([
                'Name' => $data->Name,
                'CommodityID' => $data->CommodityID,
                'PhenophaseID' => $data->PhenophaseID,
                'HealthParameterID' => $data->HealthParameterID,
                'GradeI' => $data->GradeI,
                'GradeII' => $data->GradeII,
                'GradeIII' => $data->GradeIII,
                'MinGradeI' => $data->MinGradeI,
                'MaxGradeI' => $data->MaxGradeI,
                'MinGradeII' => $data->MinGradeII,
                'MaxGradeII' => $data->MaxGradeII,
                'MinGradeIII' => $data->MinGradeIII,
                'MaxGradeIII' => $data->MaxGradeIII,
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
            return QualityChart::select(
                'ID',
                'Name',
                'CommodityID',
                'PhenophaseID',
                'HealthParameterID',
                'GradeI',
                'GradeII',
                'GradeIII',
                'MinGradeI',
                'MaxGradeI',
                'MinGradeII',
                'MaxGradeII',
                'MinGradeIII',
                'MaxGradeIII',
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
     * @param QualityChartRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(QualityChartRequest $request, int $id)
    {
        try {
            //update the record in db
            return QualityChart::where('ID', $id)->update([
                'Name' => $request->Name,
                'CommodityID' => $request->CommodityID,
                'PhenophaseID' => $request->PhenophaseID,
                'HealthParameterID' => $request->HealthParameterID,
                'GradeI' => $request->GradeI,
                'GradeII' => $request->GradeII,
                'GradeIII' => $request->GradeIII,
                'MinGradeI' => $request->MinGradeI,
                'MaxGradeI' => $request->MaxGradeI,
                'MinGradeII' => $request->MinGradeII,
                'MaxGradeII' => $request->MaxGradeII,
                'MinGradeIII' => $request->MinGradeIII,
                'MaxGradeIII' => $request->MaxGradeIII,
            ]);
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
                return QualityChart::whereIn("ID", $ids)
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
                return QualityChart::whereIn("ID", $ids)
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
                return QualityChart::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
