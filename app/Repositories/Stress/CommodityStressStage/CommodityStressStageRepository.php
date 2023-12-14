<?php

namespace App\Repositories\Stress\CommodityStressStage;

use Exception;
use App\Models\Stress\CommodityStressStage;
use App\Http\Requests\Stress\CommodityStressStage\CommodityStressStageRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Stress\CommodityStressStage\RepoInterface\CommodityStressStageRepoInterface;
use Mockery\Undefined;

class CommodityStressStageRepository implements CommodityStressStageRepoInterface
{
    /**
     * Find CommodityStressStages and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return CommodityStressStage::query()
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
                    'stage:ID,Name',
                    'phenophaseStart:ID,Name',
                    'phenophaseEnd:ID,Name'
                )
                ->select(
                    'ID',
                    'CommodityID',
                    'StressID',
                    'StageID',
                    'Description',
                    'StartPhenophaseID',
                    'EndPhenophaseID',
                    'Status'
                )
                ->orderBy('ID', 'desc')->paginate($rowsPerPage)
                ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all CommodityStressStage as per condition for dropdown listing
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            if ($search != 'undefined' && !empty($search)) {
                return CommodityStressStage::query()
                    ->select('ID', 'StressID', 'StartPhenophaseID')
                    ->when(!empty($on) && $search != 'undefined', function ($query) use ($on, $search) {
                        $query->where($on, '=', "{$search}");
                    })
                    ->with('Stress:ID,Name')
                    ->orderBy('StartPhenophaseID', 'asc')
                    ->get();
            }
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
            return CommodityStressStage::getTableFields();
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
            return CommodityStressStage::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param CommodityStressStageRequest $data
     *
     * @return Array
     */
    public function add(CommodityStressStageRequest $data)
    {
        //Create a new entry in db
        try {
            CommodityStressStage::create([
                'CommodityID' => $data->CommodityID,
                'StressID' => $data->StressID,
                'StageID' => $data->StageID,
                'Description' => $data->Description,
                'StartPhenophaseID' => $data->StartPhenophaseID,
                'EndPhenophaseID' => $data->EndPhenophaseID,
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
            return CommodityStressStage::select(
                'ID',
                'CommodityID',
                'StressID',
                'StageID',
                'Description',
                'StartPhenophaseID',
                'EndPhenophaseID'
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
     * @param CommodityStressStageRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommodityStressStageRequest $request, int $id)
    {
        try {
            $commodityStressStage = CommodityStressStage::find($id);
            $commodityStressStage->CommodityID = $request->CommodityID;
            $commodityStressStage->StressID = $request->StressID;
            $commodityStressStage->StageID = $request->StageID;
            $commodityStressStage->Description = $request->Description;
            $commodityStressStage->StartPhenophaseID = $request->StartPhenophaseID;
            $commodityStressStage->EndPhenophaseID = $request->EndPhenophaseID;
            $commodityStressStage->save();
            return $commodityStressStage;
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
                return CommodityStressStage::whereIn("ID", $ids)
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
                return CommodityStressStage::whereIn("ID", $ids)
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
                return CommodityStressStage::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
