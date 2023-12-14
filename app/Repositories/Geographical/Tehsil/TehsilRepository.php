<?php

namespace App\Repositories\Geographical\Tehsil;

use Exception;
use App\Models\Geographical\Tehsil;
use App\Http\Requests\Geographical\Tehsil\TehsilRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Geographical\Tehsil\RepoInterface\TehsilRepoInterface;

class TehsilRepository implements TehsilRepoInterface
{
    /**
     * Find Tehsils and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return Tehsil::query()
            ->select('ID','StateCode','DistrictCode','TehsilCode','Name','Status')
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
            ->with('State:ID,Name','District:ID,Name')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all Tehsils
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
         try {
            return Tehsil::query()
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
            return Tehsil::getTableFields();
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
            return Tehsil::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param TehsilRequest $data
     *
     * @return Array
     */
    public function add(TehsilRequest $data)
    {
        //Create a new entry in db
        try {
            Tehsil::create([
                'StateCode' => $data->StateCode,
                'DistrictCode' => $data->DistrictCode,
                'TehsilCode' => $data->TehsilCode,
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
            return Tehsil::select('ID','StateCode','DistrictCode','TehsilCode','Name')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param TehsilRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TehsilRequest $request, int $id)
    {
        try {

            $tehsil = Tehsil::find($id);
            $tehsil->Name = $request->Name;
            $tehsil->StateCode = $request->StateCode;
            $tehsil->DistrictCode = $request->DistrictCode;
            $tehsil->TehsilCode = $request->TehsilCode;
            $tehsil->save();
            return $tehsil;

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
            return Tehsil::whereIn("ID", $ids)
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
            return Tehsil::whereIn("ID", $ids)
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
            return Tehsil::whereIn("ID", $ids)
                ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
