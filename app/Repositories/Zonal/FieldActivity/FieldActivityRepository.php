<?php

namespace App\Repositories\Zonal\FieldActivity;

use Exception;
use App\Models\Zonal\FieldActivity;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Zonal\FieldActivity\FieldActivityRequest;
use App\Repositories\Zonal\FieldActivity\RepoInterface\FieldActivityRepoInterface;

class FieldActivityRepository implements FieldActivityRepoInterface
{
    /**
     * Find FieldActivities and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return FieldActivity::query()
            ->select('ID',
            'ZonalCommodityID',
            'PhenophaseID',
            'Name',
            'Description',
            'ImageUrl',
            'Status')
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
           ->with('ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
           'ZonalCommodity.Commodity:ID,Name',
           'ZonalCommodity.Acz:ID,Name,StateCode',
           'ZonalCommodity.Acz.State:ID,Name',
           'Phenophase:ID,Name')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }
 /**
     * Find all Villages
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
         try {
            return FieldActivity::query()
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
            return FieldActivity::getTableFields();
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
            return FieldActivity::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param FieldActivityRequest $data
     *
     * @return Array
     */
    public function add(string $fileUrl, FieldActivityRequest $data)
    {
        //Create a new entry in db
        try {
            FieldActivity::create([
                'ZonalCommodityID' => $data->ZonalCommodityID,
                'PhenophaseID' => $data->PhenophaseID,
                'Name' => $data->Name,
                'Description' => $data->Description,
                'ImageUrl' => $fileUrl,
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
            return FieldActivity::select('ID','ZonalCommodityID','PhenophaseID','Description','Name','ImageUrl')->with('ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
            'ZonalCommodity.Commodity:ID,Name',
            'ZonalCommodity.Acz:ID,Name,StateCode')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param FieldActivityRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(string $fileUrl, FieldActivityRequest $request, int $id)
    {
        try {
            $fieldActivity = FieldActivity::find($id);
            $fieldActivity->ZonalCommodityID = $request->ZonalCommodityID;
            $fieldActivity->PhenophaseID = $request->PhenophaseID;
            $fieldActivity->Name = $request->Name;
            $fieldActivity->Description = $request->Description;
            $fieldActivity->ImageUrl = $fileUrl;
            $fieldActivity->save();
            return $fieldActivity;
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
            return FieldActivity::whereIn("ID", $ids)
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
                return FieldActivity::whereIn("ID", $ids)
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
                return FieldActivity::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
