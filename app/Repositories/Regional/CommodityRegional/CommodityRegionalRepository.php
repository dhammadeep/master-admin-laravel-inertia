<?php

namespace App\Repositories\Regional\CommodityRegional;

use Exception;
use App\Models\Regional\CommodityRegional;
use App\Http\Requests\Regional\CommodityRegional\CommodityRegionalRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Regional\CommodityRegional\RepoInterface\CommodityRegionalRepoInterface;

class CommodityRegionalRepository implements CommodityRegionalRepoInterface
{
    /**
     * Find CommodityRegionals and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return CommodityRegional::query()
            ->select(
                'ID',
                'StateCode',
                'RegionID',
                'AczId',
                'ZonalCommodityID',
                'TargetValue',
                'MinLotSize',
                'MaxRigtsInLot',
                'HarvestRelaxation',
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
            ->with('State:ID,Name',
            'Region:RegionID,Name',
            'Acz:ID,Name',
            'ZonalCommodity:ID,CommodityID,SowingWeekStart,SowingWeekEnd',
            'ZonalCommodity.Commodity:ID,Name')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());

        } catch (Exception $e) {
            dd($e);
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
            return CommodityRegional::getTableFields();
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
            return CommodityRegional::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param CommodityRegionalRequest $data
     *
     * @return Array
     */
    public function add(CommodityRegionalRequest $data)
    {
        //Create a new entry in db
        try {
            CommodityRegional::create([
                'StateCode' => $data->StateCode,
                'RegionID' => $data->RegionID,
                'AczId' => $data->AczId,
                'ZonalCommodityID' => $data->ZonalCommodityID,
                'HarvestRelaxation' => $data->HarvestRelaxation,
                'MaxRigtsInLot' => $data->MaxRigtsInLot,
                'MinLotSize' => $data->MinLotSize,
                'TargetValue' => $data->TargetValue,
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
            return CommodityRegional::
            select(
                'ID',
                'StateCode',
                'RegionID',
                'AczId',
                'ZonalCommodityID',
                'TargetValue',
                'MinLotSize',
                'MaxRigtsInLot',
                'HarvestRelaxation'
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
     * @param CommodityRegionalRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommodityRegionalRequest $request, int $id)
    {
        try {
            $commodityRegional = CommodityRegional::find($id);

            $commodityRegional->StateCode = $request->StateCode;
            $commodityRegional->RegionID = $request->RegionID;
            $commodityRegional->AczId = $request->AczId;
            $commodityRegional->ZonalCommodityID = $request->ZonalCommodityID;
            $commodityRegional->HarvestRelaxation = $request->HarvestRelaxation;
            $commodityRegional->MaxRigtsInLot = $request->MaxRigtsInLot;
            $commodityRegional->MinLotSize = $request->MinLotSize;
            $commodityRegional->TargetValue = $request->TargetValue;
            $commodityRegional->save();

            return $commodityRegional;
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
            return CommodityRegional::whereIn("ID", $ids)
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
                return CommodityRegional::whereIn("ID", $ids)
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
                return CommodityRegional::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
