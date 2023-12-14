<?php

namespace App\Repositories\Agrochemicals\AgroCommoditychemical;

use Exception;
use App\Models\Agrochemicals\AgroCommoditychemical;
use App\Http\Requests\Agrochemicals\AgroCommoditychemical\AgroCommoditychemicalRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Agrochemicals\AgroCommoditychemical\RepoInterface\AgroCommoditychemicalRepoInterface;

class AgroCommoditychemicalRepository implements AgroCommoditychemicalRepoInterface
{
    /**
     * Find AgroCommoditychemicals and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return AgroCommoditychemical::query()
            ->select(
                'ID',
                'Name',
                'AgrochemicalTypeID',
                'CommodityID',
                'CIBRCApproved',
                'AgrochemicalID',
                'WaitingPeriod',
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
            ->with('commodity:ID,Name','agrochemical:ID,Name','agrochemicalType:ID,Name')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all AgroCommoditychemicals
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
         try {
           return AgroCommoditychemical::query()
           ->select(
                'ID',
                'Name'
            )
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
            return AgroCommoditychemical::getTableFields();
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
            return AgroCommoditychemical::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param AgroCommoditychemicalRequest $data
     *
     * @return Array
     */
    public function add(AgroCommoditychemicalRequest $data)
    {
        //Create a new entry in db
        try {
            AgroCommoditychemical::create([
                'CommodityID' => $data->CommodityID,
                'AgrochemicalTypeID' => $data->AgrochemicalTypeID,
                'AgrochemicalID' => $data->AgrochemicalID,
                'CIBRCApproved' => $data->CIBRCApproved,
                'WaitingPeriod' => $data->WaitingPeriod,
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
        return AgroCommoditychemical::select('ID','CommodityID','AgrochemicalTypeID','AgrochemicalID','CIBRCApproved','WaitingPeriod')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param AgroCommoditychemicalRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AgroCommoditychemicalRequest $request, int $id)
    {
        try {
            $agroCommoditychemical = AgroCommoditychemical::find($id);
            $agroCommoditychemical->CommodityID = $request->CommodityID;
            $agroCommoditychemical->AgrochemicalTypeID = $request->AgrochemicalTypeID;
            $agroCommoditychemical->AgrochemicalID = $request->AgrochemicalID;
            $agroCommoditychemical->CIBRCApproved = $request->CIBRCApproved;
            $agroCommoditychemical->WaitingPeriod = $request->WaitingPeriod;

            $agroCommoditychemical->save();

            return $agroCommoditychemical;

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
            return AgroCommoditychemical::whereIn("ID", $ids)
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
            return AgroCommoditychemical::whereIn("ID", $ids)
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
            return AgroCommoditychemical::whereIn("ID", $ids)
                ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
