<?php

namespace App\Repositories\Stress\AgrochemicalInstructions;

use Exception;
use App\Models\Stress\AgrochemicalInstructions;
use App\Http\Requests\Stress\AgrochemicalInstructions\AgrochemicalInstructionsRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Stress\AgrochemicalInstructions\RepoInterface\AgrochemicalInstructionsRepoInterface;

class AgrochemicalInstructionsRepository implements AgrochemicalInstructionsRepoInterface
{
    /**
     * Find AgrochemicalInstructions and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return AgrochemicalInstructions::query()
                ->select('ID', 'Name', 'Status')
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
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all AgrochemicalInstructions
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return AgrochemicalInstructions::query()
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
            return AgrochemicalInstructions::getTableFields();
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
            return AgrochemicalInstructions::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param AgrochemicalInstructionsRequest $data
     *
     * @return Array
     */
    public function add(AgrochemicalInstructionsRequest $data)
    {
        //Create a new entry in db
        try {
            AgrochemicalInstructions::create([
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
            return AgrochemicalInstructions::select('ID', 'Name')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param AgrochemicalInstructionsRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AgrochemicalInstructionsRequest $request, int $id)
    {
        try {
            $agrochemicalInstructions = AgrochemicalInstructions::find($id);
            $agrochemicalInstructions->Name = $request->Name;
            $agrochemicalInstructions->save();
            return $agrochemicalInstructions;
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
                return AgrochemicalInstructions::whereIn("ID", $ids)
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
                return AgrochemicalInstructions::whereIn("ID", $ids)
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
                return AgrochemicalInstructions::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
