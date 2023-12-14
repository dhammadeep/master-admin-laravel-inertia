<?php

namespace App\Repositories\Stress\StressSeverity;

use Exception;
use App\Models\Stress\StressSeverity;
use App\Http\Requests\Stress\StressSeverity\StressSeverityRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Stress\StressSeverity\RepoInterface\StressSeverityRepoInterface;

class StressSeverityRepository implements StressSeverityRepoInterface
{
    /**
     * Find StressSeverities and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return StressSeverity::query()
                ->select('ID', 'Name', 'Value', 'MinBand', 'MaxBand', 'Status')
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
     * Find all StressSeverity
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return StressSeverity::query()
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
            return StressSeverity::getTableFields();
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
            return StressSeverity::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Add a single record in the table
     *
     * @param StressSeverityRequest $data
     *
     * @return Array
     */
    public function add(StressSeverityRequest $data)
    {
        //Create a new entry in db
        try {
            StressSeverity::create([
                'Name' => $data->Name,
                'Value' => $data->Value,
                'MinBand' => $data->MinBand,
                'MaxBand' => $data->MaxBand,
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
            return StressSeverity::select(
                'ID',
                'Name',
                'Value',
                'MinBand',
                'MaxBand',
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
     * @param StressSeverityRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StressSeverityRequest $request, int $id)
    {
        try {
            $stressSeverity = StressSeverity::find($id);
            $stressSeverity->Name = $request->Name;
            $stressSeverity->Value = $request->Value;
            $stressSeverity->MinBand = $request->MinBand;
            $stressSeverity->MaxBand = $request->MaxBand;
            $stressSeverity->save();
            return $stressSeverity;
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
                return StressSeverity::whereIn("ID", $ids)
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
                return StressSeverity::whereIn("ID", $ids)
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
                return StressSeverity::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
