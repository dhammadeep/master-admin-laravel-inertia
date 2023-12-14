<?php

namespace App\Repositories\Zonal\PhenophaseDuration;

use Exception;
use App\Models\Zonal\PhenophaseDuration;
use App\Http\Requests\Zonal\PhenophaseDuration\PhenophaseDurationRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Zonal\PhenophaseDuration\RepoInterface\PhenophaseDurationRepoInterface;

class PhenophaseDurationRepository implements PhenophaseDurationRepoInterface
{
    /**
     * Find PhenophaseDurations and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return PhenophaseDuration::query()
            ->select('ID','StateCode','ZonalVarietyID','PhenophaseID','StartDas','EndDas','PhenophaseOrder','Status')
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
            'VarietyZonal:ID,CommodityID,ZonalCommodityID,VarietyID,SowingWeekStart,SowingWeekEnd','VarietyZonal.ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
            'VarietyZonal.ZonalCommodity.Commodity:ID,Name',
            'VarietyZonal.ZonalCommodity.Acz:ID,Name',
            'State:ID,Name',
            'VarietyZonal.Variety:ID,Name',
            'Phenophase:ID,Name')
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
            return PhenophaseDuration::getTableFields();
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
            return PhenophaseDuration::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param PhenophaseDurationRequest $data
     *
     * @return Array
     */
    public function add(PhenophaseDurationRequest $data)
    {
        //Create a new entry in db
        try {
            PhenophaseDuration::create([
                'StateCode'  => $data->StateCode,
                'ZonalVarietyID'  => $data->ZonalVarietyID,
                'PhenophaseID'  => $data->PhenophaseID,
                'StartDas' => $data->StartDas,
                'EndDas' => $data->EndDas,
                'PhenophaseOrder' => $data->PhenophaseOrder
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
            return PhenophaseDuration::select('ID','StateCode','ZonalVarietyID','PhenophaseID','StartDas','EndDas','PhenophaseOrder','Status')
            ->with(
                'VarietyZonal:ID,CommodityID,ZonalCommodityID,VarietyID,SowingWeekStart,SowingWeekEnd','VarietyZonal.ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
                'VarietyZonal.ZonalCommodity.Commodity:ID,Name',
                'VarietyZonal.ZonalCommodity.Acz:ID,Name,StateCode',
                'State:ID,Name',
                'VarietyZonal.Variety:ID,Name',
                'Phenophase:ID,Name')
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
     * @param PhenophaseDurationRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PhenophaseDurationRequest $request, int $id)
    {
        try {
            $phenophaseDuration = PhenophaseDuration::find($id);
            $phenophaseDuration->StateCode = $request->StateCode;
            $phenophaseDuration->ZonalVarietyID = $request->ZonalVarietyID;
            $phenophaseDuration->PhenophaseID = $request->PhenophaseID;
            $phenophaseDuration->StartDas = $request->StartDas;
            $phenophaseDuration->EndDas = $request->EndDas;
            $phenophaseDuration->PhenophaseOrder = $request->PhenophaseOrder;
            $phenophaseDuration->save();
            return $phenophaseDuration;
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
            return PhenophaseDuration::whereIn("ID", $ids)
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
                return PhenophaseDuration::whereIn("ID", $ids)
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
                return PhenophaseDuration::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
