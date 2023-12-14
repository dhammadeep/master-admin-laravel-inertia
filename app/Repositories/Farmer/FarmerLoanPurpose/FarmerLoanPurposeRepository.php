<?php

namespace App\Repositories\Farmer\FarmerLoanPurpose;

use Exception;
use App\Models\Farmer\FarmerLoanPurpose;
use App\Http\Requests\Farmer\FarmerLoanPurpose\FarmerLoanPurposeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Farmer\FarmerLoanPurpose\RepoInterface\FarmerLoanPurposeRepoInterface;

class FarmerLoanPurposeRepository implements FarmerLoanPurposeRepoInterface
{
    /**
     * Find FarmerLoanPurposes and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return FarmerLoanPurpose::query()
            ->select('ID','Name','Status')
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
            return FarmerLoanPurpose::getTableFields();
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
            return FarmerLoanPurpose::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param FarmerLoanPurposeRequest $data
     *
     * @return Array
     */
    public function add(FarmerLoanPurposeRequest $data)
    {
        //Create a new entry in db
        try {
            FarmerLoanPurpose::create([
                'Name' => $data->Name,
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
        return FarmerLoanPurpose::select('ID','Name')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param FarmerLoanPurposeRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FarmerLoanPurposeRequest $request, int $id)
    {
        try {
            $farmerLoanPurpose = FarmerLoanPurpose::find($id);
            $farmerLoanPurpose->Name = $request->Name;
            $farmerLoanPurpose->save();
            return $farmerLoanPurpose;
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
            return FarmerLoanPurpose::whereIn("ID", $ids)
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
                return FarmerLoanPurpose::whereIn("ID", $ids)
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
                return FarmerLoanPurpose::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
