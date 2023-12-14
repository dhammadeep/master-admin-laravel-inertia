<?php

namespace App\Repositories\Stress\StressStage;

use Exception;
use App\Models\Stress\StressStage;
use App\Http\Requests\Stress\StressStage\StressStageRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Stress\StressStage\RepoInterface\StressStageRepoInterface;

class StressStageRepository implements StressStageRepoInterface
{
    /**
     * Find StressStages and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return StressStage::query()
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
                ->with('stress:ID,Name', 'stage:ID,Name')
                ->select('ID', 'StressID', 'StageID', 'Status')
                ->orderBy('id', 'desc')->paginate($rowsPerPage)
                ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all StressStage
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return StressStage::query()
                ->select('ID', 'StageID')
                ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                    $query->where($on, '=', "{$search}");
                })
                ->orderBy('StageID', 'asc')
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
            return StressStage::getTableFields();
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
            return StressStage::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param StressStageRequest $data
     *
     * @return Array
     */
    public function add(StressStageRequest $data)
    {
        //Create a new entry in db
        try {
            StressStage::create([
                'StressID' => $data->StressID,
                'StageID' => $data->StageID,
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
            return StressStage::select(
                'ID',
                'StressID',
                'StageID'
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
     * @param StressStageRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StressStageRequest $request, int $id)
    {
        try {
            $stressStage = StressStage::find($id);
            $stressStage->StressID = $request->StressID;
            $stressStage->StageID = $request->StageID;
            $stressStage->save();
            return $stressStage;
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
                return StressStage::whereIn("ID", $ids)
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
        } catch (Exception $e) {
            throw $e;
        }
        $idcollection->map(function (array $ids) {
            return StressStage::whereIn("ID", $ids)
                ->update(['Status' => 'Active']);
        })->all();
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
        } catch (Exception $e) {
            throw $e;
        }
        $idcollection->map(function (array $ids) {
            return StressStage::whereIn("ID", $ids)
                ->update(['Status' => 'Approved']);
        })->all();
    }
}
