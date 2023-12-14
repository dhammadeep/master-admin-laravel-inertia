<?php

namespace App\Repositories\Zonal\Fertilizer;

use Exception;
use App\Models\Zonal\Fertilizer;
use App\Http\Requests\Zonal\Fertilizer\FertilizerRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Zonal\Fertilizer\RepoInterface\FertilizerRepoInterface;

class FertilizerRepository implements FertilizerRepoInterface
{
    /**
     * Find Fertilizers and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return Fertilizer::query()
            ->select(
                'ID',
                'ZonalCommodityID',
                'DoseFactorID',
                'Name',
                'UomID',
                'Dose',
                'Note',
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
                'Uom:ID,Name',
                'DoseFactor:ID,Name',
                'ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
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
     * Get the list of table columns for the data table
     *
     * @return array
     */
    public function getTableFields(): array
    {
        try {
            return Fertilizer::getTableFields();
        }  catch (Exception $e) {
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
            return Fertilizer::getFormFields();
        }  catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param FertilizerRequest $data
     *
     * @return Array
     */
    public function add(FertilizerRequest $data)
    {
        //Create a new entry in db
        try {
            Fertilizer::create([
                'Name' => $data->Name,
                'ZonalCommodityID' => $data->ZonalCommodityID,
                'DoseFactorID' => $data->DoseFactorID,
                'UomID' => $data->UomID,
                'Dose' => $data->Dose,
                'Note' => $data->Note,
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
            return Fertilizer::select('ID','ZonalCommodityID','DoseFactorID','Name','UomID','Dose','Note','Status')
                ->with(
                    'ZonalCommodity:ID,AczID',
                    'ZonalCommodity.Acz:ID,Name,StateCode',
                    'ZonalCommodity.Acz.State:ID,Name'
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
     * @param FertilizerRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FertilizerRequest $request, int $id)
    {
        try {
            $fertilizer = Fertilizer::find($id);
            $fertilizer->Name = $request->Name;

            $fertilizer->save();
            return $fertilizer;
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
            return Fertilizer::whereIn("ID", $ids)
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
            return Fertilizer::whereIn("ID", $ids)
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
            return Fertilizer::whereIn("ID", $ids)
                ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
