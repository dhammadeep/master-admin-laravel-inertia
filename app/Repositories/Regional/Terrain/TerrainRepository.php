<?php

namespace App\Repositories\Regional\Terrain;

use Exception;
use App\Models\Regional\Terrain;
use App\Http\Requests\Regional\Terrain\TerrainRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Regional\Terrain\RepoInterface\TerrainRepoInterface;

class TerrainRepository implements TerrainRepoInterface
{
    /**
     * Find Terrains and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return Terrain::query()
            ->select('ID','RegionID','TerrainType','MinPerKm','Status')
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
            ->with('Region:RegionID,Name')
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
            return Terrain::getTableFields();
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
            return Terrain::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param TerrainRequest $data
     *
     * @return Array
     */
    public function add(TerrainRequest $data)
    {
        //Create a new entry in db
        try {
            Terrain::create([
                'RegionID' => $data->RegionID,
                'TerrainType' => $data->TerrainType,
                'MinPerKm' => $data->MinPerKm,
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
            return Terrain::select('ID','RegionID','TerrainType','MinPerKm')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param TerrainRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TerrainRequest $request, int $id)
    {
        try {
            $terrain = Terrain::find($id);
            $terrain->RegionID = $request->RegionID;
            $terrain->TerrainType = $request->TerrainType;
            $terrain->MinPerKm = $request->MinPerKm;
            $terrain->save();
            return $terrain;
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
            return Terrain::whereIn("ID", $ids)
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
                return Terrain::whereIn("ID", $ids)
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
                return Terrain::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
