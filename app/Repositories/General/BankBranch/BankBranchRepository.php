<?php

namespace App\Repositories\General\BankBranch;

use Exception;
use App\Models\General\BankBranch;
use App\Http\Requests\General\BankBranch\BankBranchRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\General\BankBranch\RepoInterface\BankBranchRepoInterface;

class BankBranchRepository implements BankBranchRepoInterface
{
    /**
     * Find BankBranches and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return BankBranch::query()
            ->select(
                'ID',
                'Name',
                'DistrictCode',
                'BankID',
                'IFSCCode',
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
            ->with('District:ID,Name','Bank:ID,Name')
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
            return BankBranch::getTableFields();
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
            return BankBranch::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param BankBranchRequest $data
     *
     * @return Array
     */
    public function add(BankBranchRequest $data)
    {
        //Create a new entry in db
        try {
            BankBranch::create([
                'Name' => $data->Name,
                'DistrictCode' => $data->DistrictCode,
                'BankID' => $data->BankID,
                'IFSCCode' => $data->IFSCCode,
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
            return BankBranch::select('ID','Name','DistrictCode','BankID','IFSCCode')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param BankBranchRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BankBranchRequest $request, int $id)
    {
        try {
            $bankBranch = BankBranch::find($id);
            $bankBranch->Name = $request->Name;
            $bankBranch->DistrictCode = $request->DistrictCode;
            $bankBranch->BankID = $request->BankID;
            $bankBranch->IFSCCode = $request->IFSCCode;
            $bankBranch->save();
            return $bankBranch;
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
            return BankBranch::whereIn("ID", $ids)
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
            return BankBranch::whereIn("ID", $ids)
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
            return BankBranch::whereIn("ID", $ids)
                ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
