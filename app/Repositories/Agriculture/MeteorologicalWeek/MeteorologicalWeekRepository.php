<?php

namespace App\Repositories\Agriculture\MeteorologicalWeek;

use Exception;
use App\Models\Agriculture\MeteorologicalWeek;
use App\Http\Requests\Agriculture\MeteorologicalWeek\MeteorologicalWeekRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Agriculture\MeteorologicalWeek\RepoInterface\MeteorologicalWeekRepoInterface;

class MeteorologicalWeekRepository implements MeteorologicalWeekRepoInterface
{
    /**
     * Find MeteorologicalWeeks and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return MeteorologicalWeek::query()
                ->select('ID', 'WeekNo', 'StartDay', 'StartMonth', 'EndDay', 'EndMonth', 'Status')
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
     * Find all MeteorologicalWeeks
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return MeteorologicalWeek::query()
                ->select('ID', 'WeekNo')
                ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                    $query->where($on, '=', "{$search}");
                })
                ->where('Status', 'Active')
                ->orderBy('WeekNo', 'asc')
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
            return MeteorologicalWeek::getTableFields();
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
            return MeteorologicalWeek::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Add a single record in the table
     *
     * @param MeteorologicalWeekRequest $data
     *
     * @return Array
     */
    public function add(MeteorologicalWeekRequest $data)
    {
        //Create a new entry in db
        try {
            MeteorologicalWeek::create([
                'WeekNo' => $data->WeekNo,
                'StartDay' => $data->StartDay,
                'StartMonth' => $data->StartMonth,
                'EndDay' => $data->EndDay,
                'EndMonth' => $data->EndMonth,
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
            return MeteorologicalWeek::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param MeteorologicalWeekRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MeteorologicalWeekRequest $request, int $id)
    {
        try {
            $meteorologicalWeek = MeteorologicalWeek::find($id);
            $meteorologicalWeek->WeekNo = $request->WeekNo;
            $meteorologicalWeek->StartDay = $request->StartDay;
            $meteorologicalWeek->StartMonth = $request->StartMonth;
            $meteorologicalWeek->EndDay = $request->EndDay;
            $meteorologicalWeek->EndMonth = $request->EndMonth;
            $meteorologicalWeek->save();
            return $meteorologicalWeek;
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
                return MeteorologicalWeek::whereIn("ID", $ids)
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
                return MeteorologicalWeek::whereIn("ID", $ids)
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
                return MeteorologicalWeek::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
