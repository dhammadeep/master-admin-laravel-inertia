<?php

namespace App\Repositories\Yields\Health;

use Exception;
use App\Models\Yields\Health;
use App\Http\Requests\Yields\Health\HealthRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Yields\Health\RepoInterface\HealthRepoInterface;

class HealthRepository implements HealthRepoInterface
{
    /**
     * Find Healths and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return Health::query()
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
                    'CommodityID',
                    'PhenophaseID',
                    'HealthParameterID',
                    'Specification',
                    'Status'
                )
                ->orderBy('ID', 'desc')->paginate($rowsPerPage)
                ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all Health as per condition for dropdown listing
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return Health::query()
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
            return Health::getTableFields();
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
            return Health::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Add a single record in the table
     *
     * @param HealthRequest $data
     *
     * @return Array
     */
    public function add(HealthRequest $data)
    {
        //Create a new entry in db
        try {
            Health::create([
                'CommodityID' => $data->CommodityID,
                'PhenophaseID' => $data->PhenophaseID,
                'HealthParameterID' => $data->HealthParameterID,
                'Specification' => $data->Specification,
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
            return Health::select(
                'ID',
                'CommodityID',
                'PhenophaseID',
                'HealthParameterID',
                'Specification',
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
     * @param HealthRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HealthRequest $request, int $id)
    {
        try {
            //update the record in db
            return Health::where('ID', $id)->update([
                'CommodityID' => $request->CommodityID,
                'PhenophaseID' => $request->PhenophaseID,
                'HealthParameterID' => $request->HealthParameterID,
                'Specification' => $request->Specification,
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
                return Health::whereIn("ID", $ids)
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
                return Health::whereIn("ID", $ids)
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
                return Health::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
