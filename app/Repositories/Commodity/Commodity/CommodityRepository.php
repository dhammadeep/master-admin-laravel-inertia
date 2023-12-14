<?php

namespace App\Repositories\Commodity\Commodity;

use Exception;
use App\Models\Commodity\Commodity;
use App\Http\Requests\Commodity\Commodity\CommodityRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Commodity\Commodity\RepoInterface\CommodityRepoInterface;

class CommodityRepository implements CommodityRepoInterface
{
    /**
     * Find Commodity and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return Commodity::query()
            ->select(
                'ID',
                'Name',
                'ScientificName',
                'CommodityGroupID',
                'CommodityGroupIndex',
                'Logo',
                'Status'
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
            ->with('CommodityGroup:ID,Name')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Find all Commodity as per condition for dropdown listing
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return Commodity::query()
                ->select('ID','Name')
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
            return Commodity::getTableFields();
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
            return Commodity::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param CommodityRequest $data
     *
     * @return Array
     */
    public function add(string $fileUrl, CommodityRequest $data)
    {
        //Create a new entry in db
        try {
            Commodity::create([
                'Name' => $data->Name,
                'Description' => $data->Description,
                'ScientificName' => $data->ScientificName,
                'CommodityGroupID' => $data->CommodityGroupID,
                'CommodityGroupIndex' => $data->CommodityGroupIndex,
                'Logo' => $fileUrl
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
            return Commodity::select(
                'ID',
                'Name',
                'ScientificName',
                'CommodityGroupID',
                'CommodityGroupIndex',
                'Logo',
                'Description'
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
     * @param CommodityRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommodityRequest $request, int $id)
    {
        try {
            $fileUrl = $request->input('Logo');
            //update the record in db
            $Commodity = Commodity::find($id);
            $Commodity->Name = $request->Name;
            $Commodity->Description = $request->Description;
            $Commodity->ScientificName = $request->ScientificName;
            $Commodity->CommodityGroupID = $request->CommodityGroupID;
            $Commodity->CommodityGroupIndex = $request->CommodityGroupIndex;
            $Commodity->Logo =$fileUrl;
            $Commodity->save();
            return $Commodity;
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
                return Commodity::whereIn("ID", $ids)
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
                return Commodity::whereIn("ID", $ids)
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
                return Commodity::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
