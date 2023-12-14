<?php

namespace App\Repositories\Farmer\LanguageFarmer;

use Exception;
use App\Models\Farmer\LanguageFarmer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Farmer\LanguageFarmer\LanguageFarmerRequest;
use App\Repositories\Farmer\LanguageFarmer\RepoInterface\LanguageFarmerRepoInterface;

class LanguageFarmerRepository implements LanguageFarmerRepoInterface
{

    /**
     * Get the list of table columns for the data table
     *
     * @return array
     */
    public function getTableFields(): array
    {
        try {
            return LanguageFarmer::getTableFields();
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
            return LanguageFarmer::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param LanguageFarmerRequest $data
     *
     * @return Array
     */
    public function add(LanguageFarmerRequest $data)
    {
        //Create a new entry in db
        try {
            LanguageFarmer::create([
                'Name' => $data->Name
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add multiple records in the table with bulk insert query.
     * Divide the inputs in chunks and make multiple queries.
     * TODO: Implement DTO
     */
    public function addMany(LanguageFarmerRequest $data)
    {
        try {
        return LanguageFarmer::insert($data->toArray());
         } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Find LanguageFarmer and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return LanguageFarmer::query()
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
     * Find all LanguageFarmer as per condition for dropdown listing
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return LanguageFarmer::query()
                ->select('ID','Name')
                ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                    $query->where($on, '=', "{$search}");
                })
                ->orderBy('Name', 'desc')
                ->get();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find record by ID
     * @param int $id Find the record by ID
     */
    public function findById(int $id)
    {
        try {
            return LanguageFarmer::select('ID','Name')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find records by name
     */
    public function findByName()
    {
    }

    /**
     * Update a LanguageFarmer
     */


      /**
     * Update the specified resource in db.
     *
     * @param \App\Http\Requests\App\Models\Farmer\LanguageFarmer\LanguageFarmerRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LanguageFarmerRequest $request, int $id)
    {
    try {
            //update the record in db
            $languageFarmer = LanguageFarmer::find($id);
            $languageFarmer->Name = $request->Name;
            $languageFarmer->save();
         } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Soft delete a LanguageFarmer
     */
    public function delete()
    {
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
                return LanguageFarmer::whereIn("ID", $ids)
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
                return LanguageFarmer::whereIn("ID", $ids)
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
                return LanguageFarmer::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
