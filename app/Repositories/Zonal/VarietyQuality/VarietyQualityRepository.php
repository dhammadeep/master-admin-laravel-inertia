<?php

namespace App\Repositories\Zonal\VarietyQuality;

use Exception;
use App\Models\Zonal\VarietyQuality;
use App\Http\Requests\Zonal\VarietyQuality\VarietyQualityRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Zonal\VarietyQuality\RepoInterface\VarietyQualityRepoInterface;

class VarietyQualityRepository implements VarietyQualityRepoInterface
{
    /**
     * Find VarietyQualities and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return VarietyQuality::query()
            ->select('ID',
            'ZonalVarietyID',
            'CurrentQualityBandID',
            'EstimatedQualityBandID',
            'AllowableVarianceInQualityBandID',
            'IsBenchmark',
            'Status')
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
                'VarietyZonal.ZonalCommodity.Acz:ID,StateCode,Name',
                'VarietyZonal.ZonalCommodity.Acz.State:ID,Name',
                'CurrentQualityBand:ID,Name',
                'EstimatedQualityBand:ID,Name',
                'AllowableVarianceInQualityBand:ID,Name')
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
            return VarietyQuality::getTableFields();
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
            return VarietyQuality::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param VarietyQualityRequest $data
     *
     * @return Array
     */
    public function add(VarietyQualityRequest $data)
    {
        //Create a new entry in db
        try {
            VarietyQuality::create([
                'ZonalVarietyID' => $data->ZonalVarietyID,
                'CurrentQualityBandID' => $data->CurrentQualityBandID,
                'EstimatedQualityBandID' => $data->EstimatedQualityBandID,
                'AllowableVarianceInQualityBandID' => $data->AllowableVarianceInQualityBandID,
                'IsBenchmark' => $data->IsBenchmark,
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
            return VarietyQuality::select('ID',
            'ZonalVarietyID',
            'CurrentQualityBandID',
            'EstimatedQualityBandID',
            'AllowableVarianceInQualityBandID',
            'IsBenchmark')
            ->with(
                'VarietyZonal:ID,CommodityID,ZonalCommodityID,VarietyID,SowingWeekStart,SowingWeekEnd','VarietyZonal.ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
                'VarietyZonal.ZonalCommodity.Commodity:ID,Name',
                'VarietyZonal.ZonalCommodity.Acz:ID,Name,StateCode')
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
     * @param VarietyQualityRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VarietyQualityRequest $request, int $id)
    {
        try {
            $varietyQuality = VarietyQuality::find($id);
            $varietyQuality->ZonalVarietyID = $request->ZonalVarietyID;
            $varietyQuality->CurrentQualityBandID = $request->CurrentQualityBandID;
            $varietyQuality->EstimatedQualityBandID = $request->EstimatedQualityBandID;
            $varietyQuality->AllowableVarianceInQualityBandID = $request->AllowableVarianceInQualityBandID;
            $varietyQuality->IsBenchmark = $request->IsBenchmark;
            $varietyQuality->save();
            return $varietyQuality;
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
            return VarietyQuality::whereIn("ID", $ids)
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
                return VarietyQuality::whereIn("ID", $ids)
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
                return VarietyQuality::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
