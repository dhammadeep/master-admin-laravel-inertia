<?php

namespace App\Repositories\Config\SyncConfig;

use Exception;
use App\Models\Config\SyncConfig;
use App\Http\Requests\Config\SyncConfig\SyncConfigRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Config\SyncConfig\RepoInterface\SyncConfigRepoInterface;

class SyncConfigRepository implements SyncConfigRepoInterface
{
    /**
     * Find SyncConfigs and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function findAll(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return SyncConfig::query()
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
            return $e;
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
        return SyncConfig::getTableFields();
    }

    /**
     * Get the list of form elements for the form builder
     *
     * @return array
     */
    public function getFormFields(): array
    {
        return SyncConfig::getFormFields();
    }


    /**
     * Add a single record in the table
     *
     * @param SyncConfigRequest $data
     *
     * @return Array
     */
    public function add(SyncConfigRequest $data)
    {
        //Create a new entry in db
        try {
            SyncConfig::create([
                'Screen' => $data->Screen,
                'Role' => $data->Role,
                'TableName' => $data->TableName,
                'LabelName' => $data->LabelName,
                'ZippingLevel' => $data->ZippingLevel,
            ]);
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Find record by ID
     * @param int $id
     */
    public function findById(int $id)
    {
        try {
        return SyncConfig::findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param SyncConfigRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SyncConfigRequest $request, int $id)
    {
    try {
        //update the record in db
        return SyncConfig::where('ID',$id)->update([
            'Screen' => $request->Screen,
                'Role' => $request->Role,
                'TableName' => $request->TableName,
                'LabelName' => $request->LabelName,
                'ZippingLevel' => $request->ZippingLevel,
        ]);
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
        } catch (Exception $e) {
            throw $e;
        }
        $idcollection->map(function (array $ids) {
        return SyncConfig::whereIn("ID", $ids)
            ->update(['Status' => 'Rejected']);
        })->all();

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
        } catch (Exception $e) {
            throw $e;
        }
        $idcollection->map(function (array $ids) {
            return SyncConfig::whereIn("ID", $ids)
                ->update(['Status' => 'Active']);
        })->all();
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
        } catch (Exception $e) {
            throw $e;
        }
        $idcollection->map(function (array $ids) {
            return SyncConfig::whereIn("ID", $ids)
                ->update(['Status' => 'Approved']);
        })->all();
    }
}
