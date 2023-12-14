<?php

namespace App\Repositories\Farmer\FarmOwnershipType;

use Exception;
use App\Models\Farmer\FarmOwnershipType;
use App\Http\Requests\Farmer\FarmOwnershipType\FarmOwnershipTypeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Farmer\FarmOwnershipType\RepoInterface\FarmOwnershipTypeRepoInterface;

class FarmOwnershipTypeRepository implements FarmOwnershipTypeRepoInterface
{
     /**
     * Find FarmOwnershipType and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        return FarmOwnershipType::query()
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
    }

    /**
     * Get the list of table columns for the data table
     *
     * @return array
     */
    public function getTableFields(): array
    {
        return FarmOwnershipType::getTableFields();
    }

    /**
     * Get the list of form elements for the form builder
     *
     * @return array
     */
    public function getFormFields(): array
    {
        try {
            return FarmOwnershipType::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param FarmOwnershipTypeRequest $data
     *
     * @return Array
     */
    public function add(FarmOwnershipTypeRequest $data)
    {
        //Create a new entry in db
        try {
            FarmOwnershipType::create([
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
        return FarmOwnershipType::select('ID','Name')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param FarmOwnershipTypeRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FarmOwnershipTypeRequest $request, int $id)
    {
        try {
            $farmOwnershipType = FarmOwnershipType::find($id);
            $farmOwnershipType->Name = $request->Name;
            $farmOwnershipType->save();
            return $farmOwnershipType;
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
            return FarmOwnershipType::whereIn("ID", $ids)
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
                return FarmOwnershipType::whereIn("ID", $ids)
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
                return FarmOwnershipType::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
