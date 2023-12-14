<?php

namespace App\Repositories\Stress\StressControlMeasures;

use Exception;
use App\Models\Stress\StressControlMeasures;
use App\Http\Requests\Stress\StressControlMeasures\StressControlMeasuresRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Stress\StressControlMeasures\RepoInterface\StressControlMeasuresRepoInterface;

class StressControlMeasuresRepository implements StressControlMeasuresRepoInterface
{
    /**
     * Find StressControlMeasures and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return StressControlMeasures::query()
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
                    'stressSeverity:ID,Name',
                    'stressControlMeasure:ID,Name'
                )
                ->select(
                    'ID',
                    'CommodityID',
                    'StressID',
                    'StressSeverityID',
                    'StressControlMeasureID',
                    'Status'
                )
                ->orderBy('id', 'desc')->paginate($rowsPerPage)
                ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all StressControlMeasures
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return StressControlMeasures::query()
                ->select('ID', 'Name')
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
            return StressControlMeasures::getTableFields();
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
            return StressControlMeasures::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Add a single record in the table
     *
     * @param StressControlMeasuresRequest $data
     *
     * @return Array
     */
    public function add(StressControlMeasuresRequest $data)
    {
        //Create a new entry in db
        try {
            StressControlMeasures::create([
                'CommodityID' => $data->CommodityID,
                'StressID' => $data->StressID,
                'StressSeverityID' => $data->StressSeverityID,
                'StressControlMeasureID' => $data->StressControlMeasureID,
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
            return StressControlMeasures::select(
                'ID',
                'CommodityID',
                'StressID',
                'StressSeverityID',
                'StressControlMeasureID',
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
     * @param StressControlMeasuresRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StressControlMeasuresRequest $request, int $id)
    {
        try {
            $stressControlMeasures = StressControlMeasures::find($id);
            $stressControlMeasures->CommodityID = $request->CommodityID;
            $stressControlMeasures->StressID = $request->StressID;
            $stressControlMeasures->StressSeverityID = $request->StressSeverityID;
            $stressControlMeasures->StressControlMeasureID = $request->StressControlMeasureID;
            $stressControlMeasures->save();
            return $stressControlMeasures;
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
                return StressControlMeasures::whereIn("ID", $ids)
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
                return StressControlMeasures::whereIn("ID", $ids)
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
                return StressControlMeasures::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
