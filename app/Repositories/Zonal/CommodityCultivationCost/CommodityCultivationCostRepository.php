<?php

namespace App\Repositories\Zonal\CommodityCultivationCost;

use Exception;
use App\Models\Zonal\ZonalCommodity;
use App\Models\Zonal\CommodityCultivationCost;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Zonal\CommodityCultivationCost\CommodityCultivationCostRequest;
use App\Repositories\Zonal\CommodityCultivationCost\RepoInterface\CommodityCultivationCostRepoInterface;

class CommodityCultivationCostRepository implements CommodityCultivationCostRepoInterface
{
    /**
     * Find CommodityCultivationCosts and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return CommodityCultivationCost::query()
            ->select(
                'ID',
                'ZonalCommodityID',
                'CostOfCultivation',
                'CostOfProduction',
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
            ->with('ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
            'ZonalCommodity.Commodity:ID,Name',
            'ZonalCommodity.Acz:ID,Name,StateCode',
            'ZonalCommodity.Acz.State:ID,Name')
             ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());
        } catch (Exception $e) {
            dd($e);
            throw $e;
        }
    }

      /**
     * Find all Villages
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
         try {
            return ZonalCommodity::query()
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
            return CommodityCultivationCost::getTableFields();
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
            return CommodityCultivationCost::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param CommodityCultivationCostRequest $data
     *
     * @return Array
     */
    public function add(CommodityCultivationCostRequest $data)
    {
        //Create a new entry in db
        try {
            CommodityCultivationCost::create([
                'ZonalCommodityID' => $data->ZonalCommodityID,
                'CostOfCultivation' => $data->CostOfCultivation,
                'CostOfProduction' => $data->CostOfProduction,
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
            return CommodityCultivationCost::select(
                'ZonalCommodityID',
                'CostOfCultivation',
                'CostOfProduction'
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
     * @param CommodityCultivationCostRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommodityCultivationCostRequest $request, int $id)
    {
        try {
            $commodityCultivationCost = CommodityCultivationCost::find($id);
            $commodityCultivationCost->ZonalCommodityID = $request->ZonalCommodityID;
            $commodityCultivationCost->CostOfCultivation = $request->CostOfCultivation;
            $commodityCultivationCost->CostOfProduction = $request->CostOfProduction;
            $commodityCultivationCost->save();
            return $commodityCultivationCost;
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
            return CommodityCultivationCost::whereIn("ID", $ids)
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
                return CommodityCultivationCost::whereIn("ID", $ids)
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
                return CommodityCultivationCost::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
