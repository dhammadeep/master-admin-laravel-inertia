<?php

namespace App\Repositories\Commodity\StateCommodity;

use Exception;
use App\Models\Commodity\StateCommodity;
use App\Http\Requests\Commodity\StateCommodity\StateCommodityRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Commodity\StateCommodity\RepoInterface\StateCommodityRepoInterface;

class StateCommodityRepository implements StateCommodityRepoInterface
{
     /**
     * Find StateCommodity and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return StateCommodity::query()
                ->select(
                    'ID',
                    'StateCode',
                    'CommodityID'
                )
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
                ->with('Commodity:ID,Name','State:ID,Name')
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
            return StateCommodity::getTableFields();
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
            return StateCommodity::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param StateCommodityRequest $data
     *
     * @return Array
     */
    public function add(StateCommodityRequest $data)
    {
        //Create a new entry in db
        try {
            StateCommodity::create([
                'StateCode' => $data->StateCode,
                'CommodityID' => $data->CommodityID
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
        return StateCommodity::select(
            'ID',
            'StateCode',
            'CommodityID'
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
     * @param StateCommodityRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StateCommodityRequest $request, int $id)
    {
        try {
            $stateCommodity = StateCommodity::find($id);
            $stateCommodity->StateCode = $request->StateCode;
            $stateCommodity->CommodityID = $request->CommodityID;
            $stateCommodity->save();
            return $stateCommodity;
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
            return StateCommodity::whereIn("ID", $ids)
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
                return StateCommodity::whereIn("ID", $ids)
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
                return StateCommodity::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
