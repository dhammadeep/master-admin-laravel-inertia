<?php

namespace App\Repositories\Zonal\StressControl;

use Exception;
use App\Models\Zonal\StressControl;
use App\Http\Requests\Zonal\StressControl\StressControlRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Zonal\StressControl\RepoInterface\StressControlRepoInterface;

class StressControlRepository implements StressControlRepoInterface
{
    /**
     * Find StressControls and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return StressControl::query()
            ->select(
                'ID',
                'ZonalCommodityID',
                'StressControlMeasureID',
                'StressID',
                'RecomendationID',
                'AgrochemicalInstructionID',
                'AgrochemApplicationTypeID',
                'AgrochemicalID',
                'DosePerAcre',
                'PerAcreUomID',
                'WaterPerAcre',
                'PerAcreWaterUomID',
                'DosePerLitre',
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
            'ZonalCommodity.Acz.State:ID,Name',
            'ControlMeasure:ID,Name',
            'Stress:ID,Name',
            'Recomendation:ID,Name',
            'AgrochemicalInstruction:ID,Name',
            'AgrochemApplicationType:ID,Name',
            'ZonalCommodity.AgroCommoditychemical.Agrochemical:ID,Name',
            'PerAcreUom:ID,Name',
            'PerAcreWaterUom:ID,Name')
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
            return StressControl::getTableFields();
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
            return StressControl::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param StressControlRequest $data
     *
     * @return Array
     */
    public function add(StressControlRequest $data)
    {
        //Create a new entry in db
        try {
            StressControl::create([
                'ZonalCommodityID' => $data->ZonalCommodityID,
                'StressControlMeasureID' => $data->StressControlMeasureID,
                'StressID' => $data->StressID,
                'RecomendationID' => $data->RecomendationID,
                'AgrochemicalInstructionID' => $data->AgrochemicalInstructionID,
                'AgrochemApplicationTypeID' => $data->AgrochemApplicationTypeID,
                'AgrochemicalID' => $data->AgrochemicalID,
                'DosePerAcre' => $data->DosePerAcre,
                'PerAcreUomID' => $data->PerAcreUomID,
                'WaterPerAcre' => $data->WaterPerAcre,
                'PerAcreWaterUomID' => $data->PerAcreWaterUomID,
                'DosePerLitre' => $data->DosePerLitre
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
            return StressControl::select(
                'ID',
                'ZonalCommodityID',
                'StressControlMeasureID',
                'StressID',
                'RecomendationID',
                'AgrochemicalInstructionID',
                'AgrochemApplicationTypeID',
                'AgrochemicalID',
                'DosePerAcre',
                'PerAcreUomID',
                'WaterPerAcre',
                'PerAcreWaterUomID',
                'DosePerLitre'
            )
            ->with('ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
            'ZonalCommodity.Commodity:ID,Name',
            'ZonalCommodity.Acz:ID,Name,StateCode',
            'ZonalCommodity.Acz.State:ID,Name',
            'ZonalCommodity.AgroCommoditychemical.Agrochemical:ID,Name'
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
     * @param StressControlRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StressControlRequest $request, int $id)
    {
        try {
            $stressControl = StressControl::find($id);
            $stressControl->ZonalCommodityID = $request->ZonalCommodityID;
            $stressControl->StressID = $request->StressID;
            $stressControl->RecomendationID = $request->RecomendationID;
            $stressControl->AgrochemicalInstructionID = $request->AgrochemicalInstructionID;
            $stressControl->AgrochemApplicationTypeID = $request->AgrochemApplicationTypeID;
            $stressControl->AgrochemicalID = $request->AgrochemicalID;
            $stressControl->DosePerAcre = $request->DosePerAcre;
            $stressControl->PerAcreUomID = $request->PerAcreUomID;
            $stressControl->WaterPerAcre = $request->WaterPerAcre;
            $stressControl->PerAcreWaterUomID = $request->PerAcreWaterUomID;
            $stressControl->DosePerLitre = $request->DosePerLitre;

            $stressControl->save();
            return $stressControl;
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
            return StressControl::whereIn("ID", $ids)
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
                return StressControl::whereIn("ID", $ids)
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
                return StressControl::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
