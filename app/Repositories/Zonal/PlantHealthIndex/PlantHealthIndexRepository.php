<?php

namespace App\Repositories\Zonal\PlantHealthIndex;

use Exception;
use App\Models\Zonal\PlantHealthIndex;
use App\Http\Requests\Zonal\PlantHealthIndex\PlantHealthIndexRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Zonal\PlantHealthIndex\RepoInterface\PlantHealthIndexRepoInterface;

class PlantHealthIndexRepository implements PlantHealthIndexRepoInterface
{
    /**
     * Find PlantHealthIndices and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return PlantHealthIndex::query()
            ->select(
                'ID',
                'ZonalVarietyID',
                'PhenophaseID',
                'HealthParameterID',
                'Specifications',
                'NormalValue',
                'IdealValue',
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
            ->with(
                'VarietyZonal:ID,CommodityID,ZonalCommodityID,VarietyID,SowingWeekStart,SowingWeekEnd','VarietyZonal.ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
                'VarietyZonal.ZonalCommodity.Commodity:ID,Name',
                'VarietyZonal.ZonalCommodity.Acz:ID,Name,StateCode',
                'VarietyZonal.ZonalCommodity.Acz.State:ID,Name',
                'VarietyZonal.Variety:ID,Name',
                'Phenophase:ID,Name',
                'HealthParameter:ID,Name')
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
            return PlantHealthIndex::getTableFields();
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
            return PlantHealthIndex::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param PlantHealthIndexRequest $data
     *
     * @return Array
     */
    public function add(PlantHealthIndexRequest $data)
    {
        //Create a new entry in db
        try {
            PlantHealthIndex::create([
                'ZonalVarietyID'  => $data->ZonalVarietyID,
                'PhenophaseID'  => $data->PhenophaseID,
                'HealthParameterID'  => $data->HealthParameterID,
                'Specifications' => $data->Specifications,
                'NormalValue' => $data->NormalValue,
                'IdealValue' => $data->IdealValue
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
            return PlantHealthIndex::select(
                'ID',
                'ZonalVarietyID',
                'PhenophaseID',
                'HealthParameterID',
                'Specifications',
                'NormalValue',
                'IdealValue',
                'Status'
            )
            ->with(
                'VarietyZonal:ID,CommodityID,ZonalCommodityID,VarietyID','VarietyZonal.ZonalCommodity:ID,AczID',
                'VarietyZonal.ZonalCommodity.Acz:ID,StateCode',
                'VarietyZonal.Variety:ID,Name',
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
     * @param PlantHealthIndexRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PlantHealthIndexRequest $request, int $id)
    {
        try {
            $plantHealthIndex = PlantHealthIndex::find($id);
            $plantHealthIndex->ZonalVarietyID = $request->ZonalVarietyID;
            $plantHealthIndex->PhenophaseID = $request->PhenophaseID;
            $plantHealthIndex->HealthParameterID = $request->HealthParameterID;
            $plantHealthIndex->Specifications = $request->Specifications;
            $plantHealthIndex->NormalValue = $request->NormalValue;
            $plantHealthIndex->IdealValue = $request->IdealValue;
            $plantHealthIndex->save();
            return $plantHealthIndex;
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
            return PlantHealthIndex::whereIn("ID", $ids)
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
                return PlantHealthIndex::whereIn("ID", $ids)
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
                return PlantHealthIndex::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
