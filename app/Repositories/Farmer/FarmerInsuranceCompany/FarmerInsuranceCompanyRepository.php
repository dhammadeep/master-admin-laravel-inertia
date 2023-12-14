<?php

namespace App\Repositories\Farmer\FarmerInsuranceCompany;

use Exception;
use App\Models\Farmer\FarmerInsuranceCompany;
use App\Http\Requests\Farmer\FarmerInsuranceCompany\FarmerInsuranceCompanyRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Farmer\FarmerInsuranceCompany\RepoInterface\FarmerInsuranceCompanyRepoInterface;

class FarmerInsuranceCompanyRepository implements FarmerInsuranceCompanyRepoInterface
{
    /**
     * Find FarmerInsuranceCompanies and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return FarmerInsuranceCompany::query()
            ->select('ID','Name','InsuranceTypeID','Status')
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
            ->with('FarmerInsuranceType:ID,Name')
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
            return FarmerInsuranceCompany::getTableFields();
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
            return FarmerInsuranceCompany::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param FarmerInsuranceCompanyRequest $data
     *
     * @return Array
     */
    public function add(FarmerInsuranceCompanyRequest $data)
    {
        //Create a new entry in db
        try {
            FarmerInsuranceCompany::create([
                'Name' => $data->Name,
                'InsuranceTypeID' => $data->InsuranceTypeID,
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
        return FarmerInsuranceCompany::select('ID','Name','InsuranceTypeID')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param FarmerInsuranceCompanyRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FarmerInsuranceCompanyRequest $request, int $id)
    {
        try {
            $farmerInsuranceCompany = FarmerInsuranceCompany::find($id);
            $farmerInsuranceCompany->Name = $request->Name;
            $farmerInsuranceCompany->InsuranceTypeID = $request->InsuranceTypeID;
            $farmerInsuranceCompany->save();
            return $farmerInsuranceCompany;
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
        } catch (Exception $e) {
            throw $e;
        }
        $idcollection->map(function (array $ids) {
        return FarmerInsuranceCompany::whereIn("ID", $ids)
            ->update(['Status' => 'Rejected']);
        })->all();

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
        } catch (Exception $e) {
            throw $e;
        }
        $idcollection->map(function (array $ids) {
            return FarmerInsuranceCompany::whereIn("ID", $ids)
                ->update(['Status' => 'Active']);
        })->all();
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
                return FarmerInsuranceCompany::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
