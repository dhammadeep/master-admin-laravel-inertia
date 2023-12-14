<?php

namespace App\Repositories\Geographical\Panchayat;

use Exception;
use App\Models\Geographical\Panchayat;
use App\Http\Requests\Geographical\Panchayat\PanchayatRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Geographical\Panchayat\RepoInterface\PanchayatRepoInterface;

class PanchayatRepository implements PanchayatRepoInterface
{
    /**
     * Find Panchayats and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return Panchayat::query()
            ->select('ID','StateCode','DistrictCode','TehsilCode','PanchayatCode','Name','Status')
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
            ->with('State:ID,Name','District:ID,Name','Tehsil:ID,Name')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all Panchayats
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
         try {
            return Panchayat::query()
            ->select('ID','Name')
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
            return Panchayat::getTableFields();
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
            return Panchayat::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param PanchayatRequest $data
     *
     * @return Array
     */
    public function add(PanchayatRequest $data)
    {
        //Create a new entry in db
        try {
            Panchayat::create([
                'Name' => $data->Name,
                'StateCode' => $data->StateCode,
                'DistrictCode' => $data->DistrictCode,
                'TehsilCode' => $data->TehsilCode,
                'PanchayatCode' => $data->PanchayatCode,
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
            return Panchayat::select('ID','StateCode','DistrictCode','TehsilCode','PanchayatCode','Name')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param PanchayatRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PanchayatRequest $request, int $id)
    {
        try {
            $panchayat = Panchayat::find($id);
            $panchayat->Name = $request->Name;
            $panchayat->StateCode = $request->StateCode;
            $panchayat->DistrictCode = $request->DistrictCode;
            $panchayat->TehsilCode = $request->TehsilCode;
            $panchayat->PanchayatCode = $request->PanchayatCode;
            $panchayat->save();

            return $panchayat;
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
            return Panchayat::whereIn("ID", $ids)
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
                return Panchayat::whereIn("ID", $ids)
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
                return Panchayat::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
