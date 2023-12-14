<?php

namespace App\Repositories\Phenophase\CommodityPhenophase;

use Exception;
use App\Models\Phenophase\CommodityPhenophase;
use App\Http\Requests\Phenophase\CommodityPhenophase\CommodityPhenophaseRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Phenophase\CommodityPhenophase\RepoInterface\CommodityPhenophaseRepoInterface;

class CommodityPhenophaseRepository implements CommodityPhenophaseRepoInterface
{
    /**
     * Find CommodityPhenophases and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return CommodityPhenophase::query()
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
                ->with('commodity:ID,Name', 'phenophase:ID,Name')
                ->select('ID', 'CommodityID', 'PhenophaseID', 'Status')
                ->orderBy('id', 'desc')->paginate($rowsPerPage)
                ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all CommodityPhenophase as per condition for dropdown listing
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return CommodityPhenophase::query()
                ->select('ID', 'PhenophaseID')
                ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                    $query->where($on, '=', "{$search}");
                })
                ->with('Phenophase:ID,Name')
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
            return CommodityPhenophase::getTableFields();
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
            return CommodityPhenophase::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Add a single record in the table
     *
     * @param CommodityPhenophaseRequest $data
     *
     * @return Array
     */
    public function add(CommodityPhenophaseRequest $data)
    {
        //Create a new entry in db
        try {
            CommodityPhenophase::create([
                'CommodityID' => $data->CommodityID,
                'PhenophaseID' => $data->PhenophaseID,
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
            return CommodityPhenophase::select('ID', 'CommodityID', 'PhenophaseID')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param CommodityPhenophaseRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommodityPhenophaseRequest $request, int $id)
    {
        try {
            $commodityPhenophase = CommodityPhenophase::find($id);
            $commodityPhenophase->CommodityID = $request->CommodityID;
            $commodityPhenophase->PhenophaseID = $request->PhenophaseID;
            $commodityPhenophase->save();
            return $commodityPhenophase;
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
                return CommodityPhenophase::whereIn("ID", $ids)
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
                return CommodityPhenophase::whereIn("ID", $ids)
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
                return CommodityPhenophase::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
