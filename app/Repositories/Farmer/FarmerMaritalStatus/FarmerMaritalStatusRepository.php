<?php

namespace App\Repositories\Farmer\FarmerMaritalStatus;

use Exception;
use App\Models\Farmer\FarmerMaritalStatus;
use App\Http\Requests\Farmer\FarmerMaritalStatus\FarmerMaritalStatusRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Farmer\FarmerMaritalStatus\RepoInterface\FarmerMaritalStatusRepoInterface;

class FarmerMaritalStatusRepository implements FarmerMaritalStatusRepoInterface
{
    /**
     * Find FarmerMaritalStatuses and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return FarmerMaritalStatus::query()
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
            return FarmerMaritalStatus::getTableFields();
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
            return FarmerMaritalStatus::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param FarmerMaritalStatusRequest $data
     *
     * @return Array
     */
    public function add(FarmerMaritalStatusRequest $data)
    {
        //Create a new entry in db
        try {
            FarmerMaritalStatus::create([
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
        return FarmerMaritalStatus::select('ID','Name')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param FarmerMaritalStatusRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FarmerMaritalStatusRequest $request, int $id)
    {
        try {
            $farmerMaritalStatus = FarmerMaritalStatus::find($id);
            $farmerMaritalStatus->Name = $request->Name;
            $farmerMaritalStatus->save();
            return $farmerMaritalStatus;
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
            return FarmerMaritalStatus::whereIn("ID", $ids)
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
                return FarmerMaritalStatus::whereIn("ID", $ids)
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
                return FarmerMaritalStatus::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
