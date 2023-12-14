<?php

namespace App\Repositories\Commodity\HSNCode;

use Exception;
use App\Models\Commodity\HSNCode;
use App\Http\Requests\Commodity\HSNCode\HSNCodeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Commodity\HSNCode\RepoInterface\HSNCodeRepoInterface;

class HSNCodeRepository implements HSNCodeRepoInterface
{
    /**
     * Find HSNCode and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return HSNCode::query()
                ->select(
                    'ID',
                    'CommodityID',
                    'GeneralCommodityID',
                    'CommodityClassID',
                    'HSCode',
                    'UomID',
                    'Description',
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
                ->with('Commodity:ID,Name','GeneralCommodity:ID,Name','CommodityClass:ID,Name','Uom:ID,Name')
                ->orderBy('id', 'desc')->paginate($rowsPerPage)
                ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Find all HSNCode as per condition for dropdown listing
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return HSNCode::query()
                ->select('ID','HSCode')
                ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                    $query->where($on, '=', "{$search}");
                })
                ->orderBy('HSCode', 'desc')
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
            return HSNCode::getTableFields();
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
            return HSNCode::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param HSNCodeRequest $data
     *
     * @return Array
     */
    public function add(HSNCodeRequest $data)
    {
        // dump($data->Description);
        //Create a new entry in db
        try {
            HSNCode::create([
                'CommodityID' => $data->CommodityID,
                'GeneralCommodityID' => $data->GeneralCommodityID,
                'CommodityClassID' => $data->CommodityClassID,
                'HSCode' => $data->HSCode,
                'UomID' => $data->UomID,
                'Description' => $data->Description
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
            return HSNCode::select(
                'ID',
                'CommodityID',
                'GeneralCommodityID',
                'CommodityClassID',
                'HSCode',
                'UomID',
                'Description',
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
     * @param HSNCodeRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HSNCodeRequest $request, int $id)
    {
    try {
        //update the record in db
        $hsnCode = HSNCode::find($id);
        $hsnCode->CommodityID = $request->CommodityID;
        $hsnCode->GeneralCommodityID = $request->GeneralCommodityID;
        $hsnCode->CommodityClassID = $request->CommodityClassID;
        $hsnCode->HSCode = $request->HSCode;
        $hsnCode->UomID = $request->UomID;
        $hsnCode->Description = $request->Description;
        $hsnCode->save();
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
            return HSNCode::whereIn("ID", $ids)
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
                return HSNCode::whereIn("ID", $ids)
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
                return HSNCode::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
