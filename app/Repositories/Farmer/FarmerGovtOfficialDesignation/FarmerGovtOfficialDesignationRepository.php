<?php

namespace App\Repositories\Farmer\FarmerGovtOfficialDesignation;

use Exception;
use App\Models\Farmer\FarmerGovtOfficialDesignation;
use App\Http\Requests\Farmer\FarmerGovtOfficialDesignation\FarmerGovtOfficialDesignationRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Farmer\FarmerGovtOfficialDesignation\RepoInterface\FarmerGovtOfficialDesignationRepoInterface;

class FarmerGovtOfficialDesignationRepository implements FarmerGovtOfficialDesignationRepoInterface
{
    /**
     * Find FarmerGovtOfficialDesignations and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return FarmerGovtOfficialDesignation::query()
            ->select('ID','DepartmentID','Name','Status')
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
            ->with('FarmerGovtDepartment:ID,Name')
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
            return FarmerGovtOfficialDesignation::getTableFields();
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
            return FarmerGovtOfficialDesignation::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param FarmerGovtOfficialDesignationRequest $data
     *
     * @return Array
     */
    public function add(FarmerGovtOfficialDesignationRequest $data)
    {
        //Create a new entry in db
        try {
            FarmerGovtOfficialDesignation::create([
                'DepartmentID' => $data->DepartmentID,
                'Name' => $data->Name
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
        return FarmerGovtOfficialDesignation::select('ID','DepartmentID','Name')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param FarmerGovtOfficialDesignationRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FarmerGovtOfficialDesignationRequest $request, int $id)
    {
        try {
            $farmerGovtOfficialDesignation = FarmerGovtOfficialDesignation::find($id);
            $farmerGovtOfficialDesignation->DepartmentID = $request->DepartmentID;
            $farmerGovtOfficialDesignation->Name = $request->Name;
            $farmerGovtOfficialDesignation->save();
            return $farmerGovtOfficialDesignation;
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
            return FarmerGovtOfficialDesignation::whereIn("ID", $ids)
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
                return FarmerGovtOfficialDesignation::whereIn("ID", $ids)
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
                return FarmerGovtOfficialDesignation::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
