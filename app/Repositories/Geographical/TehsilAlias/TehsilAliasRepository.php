<?php

namespace App\Repositories\Geographical\TehsilAlias;

use Exception;
use App\Models\Geographical\TehsilAlias;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Geographical\TehsilAlias\TehsilAliasRequest;
use App\Repositories\Geographical\TehsilAlias\RepoInterface\TehsilAliasRepoInterface;

class TehsilAliasRepository implements TehsilAliasRepoInterface
{
    /**
     * Find TehsilAliases and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return TehsilAlias::query()
            ->select('ID','StateCode','DistrictCode','TehsilCode','Alias','Status')
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
     * Get the list of table columns for the data table
     *
     * @return array
     */
    public function getTableFields(): array
    {
        try {
            return TehsilAlias::getTableFields();
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
            return TehsilAlias::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param TehsilAliasRequest $data
     *
     * @return Array
     */
    public function add(TehsilAliasRequest $data)
    {

        //Create a new entry in db
        try {
            TehsilAlias::create([
                'StateCode' => $data->StateCode,
                'DistrictCode' => $data->DistrictCode,
                'Alias' => $data->Alias,
                'TehsilCode' => $data->TehsilCode,
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
            return TehsilAlias::select('ID','StateCode','DistrictCode','TehsilCode','Alias')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param TehsilAliasRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TehsilAliasRequest $request, int $id)
    {
        try {
            $tehsilAlias = TehsilAlias::find($id);
            $tehsilAlias->StateCode = $request->StateCode;
            $tehsilAlias->DistrictCode = $request->DistrictCode;
            $tehsilAlias->Alias = $request->Alias;
            $tehsilAlias->TehsilCode = $request->TehsilCode;
            $tehsilAlias->save();
            return $tehsilAlias;

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
            return TehsilAlias::whereIn("ID", $ids)
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
            return TehsilAlias::whereIn("ID", $ids)
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
                return TehsilAlias::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
