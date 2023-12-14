<?php

namespace App\Repositories\Stress\SeedTreatment;

use Exception;
use App\Models\Stress\SeedTreatment;
use App\Http\Requests\Stress\SeedTreatment\SeedTreatmentRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Stress\SeedTreatment\RepoInterface\SeedTreatmentRepoInterface;

class SeedTreatmentRepository implements SeedTreatmentRepoInterface
{
    /**
     * Find SeedTreatments and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return SeedTreatment::query()
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
                ->with('commodity:ID,Name', 'variety:ID,Name', 'uom:ID,Name')
                ->select('ID', 'CommodityID', 'VarietyID', 'UomID', 'Name', 'Dose', 'Status')
                ->orderBy('id', 'desc')->paginate($rowsPerPage)
                ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all SeedTreatments
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return SeedTreatment::query()
                ->select('ID', 'Name')
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
            return SeedTreatment::getTableFields();
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
            return SeedTreatment::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Add a single record in the table
     *
     * @param SeedTreatmentRequest $data
     *
     * @return Array
     */
    public function add(SeedTreatmentRequest $data)
    {
        //Create a new entry in db
        try {
            SeedTreatment::create([
                'CommodityID' => $data->CommodityID,
                'VarietyID' => $data->VarietyID,
                'UomID' => $data->UomID,
                'Name' => $data->Name,
                'Dose' => $data->Dose,
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
            return SeedTreatment::select(
                'ID',
                'CommodityID',
                'VarietyID',
                'UomID',
                'Name',
                'Dose',
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
     * @param SeedTreatmentRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SeedTreatmentRequest $request, int $id)
    {
        try {
            $seedTreatment = SeedTreatment::find($id);
            $seedTreatment->CommodityID = $request->CommodityID;
            $seedTreatment->VarietyID = $request->VarietyID;
            $seedTreatment->UomID = $request->UomID;
            $seedTreatment->Name = $request->Name;
            $seedTreatment->Dose = $request->Dose;
            $seedTreatment->save();
            return $seedTreatment;
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
                return SeedTreatment::whereIn("ID", $ids)
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
                return SeedTreatment::whereIn("ID", $ids)
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
                return SeedTreatment::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
