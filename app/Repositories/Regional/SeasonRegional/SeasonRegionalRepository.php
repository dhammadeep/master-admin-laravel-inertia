<?php

namespace App\Repositories\Regional\SeasonRegional;

use Exception;
use App\Models\Regional\SeasonRegional;
use App\Http\Requests\Regional\SeasonRegional\SeasonRegionalRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Regional\SeasonRegional\RepoInterface\SeasonRegionalRepoInterface;

class SeasonRegionalRepository implements SeasonRegionalRepoInterface
{
    /**
     * Find SeasonRegionals and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return SeasonRegional::query()
                ->select(
                    'ID',
                    'StateCode',
                    'SeasonID',
                    'SeasonStartWeek',
                    'SeasonEndWeek',
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
                ->with('State:ID,Name', 'Season:ID,Name')
                ->orderBy('id', 'desc')->paginate($rowsPerPage)
                ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all CommodityStressStage as per condition for dropdown listing
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            if ($search != 'undefined' && !empty($search)) {
                return SeasonRegional::query()
                    ->select('ID', 'StateCode', 'SeasonID')
                    ->when(!empty($on) && $search != 'undefined', function ($query) use ($on, $search) {
                        $query->where($on, '=', "{$search}");
                    })
                    ->with('Season:ID,Name')
                    ->orderBy('StateCode', 'asc')
                    ->get();
            }
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
            return SeasonRegional::getTableFields();
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
            return SeasonRegional::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param SeasonRegionalRequest $data
     *
     * @return Array
     */
    public function add(SeasonRegionalRequest $data)
    {
        //Create a new entry in db
        try {
            SeasonRegional::create([
                'StateCode' => $data->StateCode,
                'SeasonID' => $data->SeasonID,
                'SeasonStartWeek' => $data->SeasonStartWeek,
                'SeasonEndWeek' => $data->SeasonEndWeek,
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
            return SeasonRegional::select(
                'ID',
                'StateCode',
                'SeasonID',
                'SeasonStartWeek',
                'SeasonEndWeek'
            )
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param SeasonRegionalRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SeasonRegionalRequest $request, int $id)
    {
        try {
            $seasonRegional = SeasonRegional::find($id);
            $seasonRegional->StateCode = $request->StateCode;
            $seasonRegional->SeasonID = $request->SeasonID;
            $seasonRegional->SeasonStartWeek = $request->SeasonStartWeek;
            $seasonRegional->SeasonEndWeek = $request->SeasonEndWeek;
            $seasonRegional->save();
            return $seasonRegional;
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
                return SeasonRegional::whereIn("ID", $ids)
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
                return SeasonRegional::whereIn("ID", $ids)
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
                return SeasonRegional::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
