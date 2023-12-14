<?php

namespace App\Repositories\Agriculture\BenchmarkVariety;

use Exception;
use App\Models\Agriculture\BenchmarkVariety;
use App\Http\Requests\Agriculture\BenchmarkVariety\BenchmarkVarietyRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Agriculture\BenchmarkVariety\RepoInterface\BenchmarkVarietyRepoInterface;

class BenchmarkVarietyRepository implements BenchmarkVarietyRepoInterface
{
    /**
     * Find BenchmarkVarieties and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return BenchmarkVariety::query()
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
                ->with(
                    'Region:RegionID,Name',
                    'State:ID,Name',
                    'Season:ID,Name',
                    'Commodity:ID,Name',
                    'Variety:ID,Name'
                )
                ->select(
                    'ID',
                    'StateCode',
                    'RegionID',
                    'SeasonID',
                    'CommodityID',
                    'VarietyID',
                    'IsDrkBenchmark',
                    'IsAgmBenchmark',
                    'Status'
                )
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
            return BenchmarkVariety::getTableFields();
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
            return BenchmarkVariety::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Add a single record in the table
     *
     * @param BenchmarkVarietyRequest $data
     *
     * @return Array
     */
    public function add(BenchmarkVarietyRequest $data)
    {
        //Create a new entry in db
        try {
            BenchmarkVariety::create([
                'StateCode' => $data->StateCode,
                'RegionID' => $data->RegionID,
                'SeasonID' => $data->SeasonID,
                'CommodityID' => $data->CommodityID,
                'VarietyID' => $data->VarietyID,
                'IsDrkBenchmark' => $data->IsDrkBenchmark,
                'IsAgmBenchmark' => $data->IsAgmBenchmark,
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
            return BenchmarkVariety::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param BenchmarkVarietyRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BenchmarkVarietyRequest $request, int $id)
    {
        try {
            $benchmarkVariety = BenchmarkVariety::find($id);
            $benchmarkVariety->StateCode = $request->StateCode;
            $benchmarkVariety->RegionID = $request->RegionID;
            $benchmarkVariety->SeasonID = $request->SeasonID;
            $benchmarkVariety->CommodityID = $request->CommodityID;
            $benchmarkVariety->VarietyID = $request->VarietyID;
            $benchmarkVariety->IsDrkBenchmark = $request->IsDrkBenchmark;
            $benchmarkVariety->IsAgmBenchmark = $request->IsAgmBenchmark;
            $benchmarkVariety->save();
            return $benchmarkVariety;
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
                return BenchmarkVariety::whereIn("ID", $ids)
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
                return BenchmarkVariety::whereIn("ID", $ids)
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
                return BenchmarkVariety::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
