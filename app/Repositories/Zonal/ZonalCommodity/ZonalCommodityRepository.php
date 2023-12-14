<?php

namespace App\Repositories\Zonal\ZonalCommodity;

use Exception;
use App\Models\Zonal\ZonalCommodity;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Zonal\ZonalCommodity\ZonalCommodityRequest;
use App\Repositories\Zonal\ZonalCommodity\RepoInterface\ZonalCommodityRepoInterface;

class ZonalCommodityRepository implements ZonalCommodityRepoInterface
{
    /**
     * Find ZonalCommodity and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return ZonalCommodity::query()
            ->select(
                'ID',
                'AczID',
                'CommodityID',
                'SowingWeekStart',
                'SowingWeekEnd',
                'HarvestWeekStart',
                'HarvestWeekEnd',
                'NoOfDaysForHarvestMonitoring',
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
            ->with('Commodity:ID,Name',
            'Acz:ID,Name,StateCode',
            'Acz.State:ID,Name')
             ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all zonal Commodity with comoodity
     * @param string $on The field to search
     * @param string $search The value to search
     */
    public function all(string $on = null, string $search = null)
    {
         try {
           return ZonalCommodity::query()
           ->select(
            'ID',
            'AczId',
            'CommodityID',
            'SowingWeekStart',
            'SowingWeekEnd',
        )
            ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                $query->where($on, '=', "{$search}");
            })
            ->with('commodity:ID,Name')
            ->orderBy('ID', 'asc')
            ->get();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all CommodityPhenophase as per condition for dropdown listing
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function allPhenophaseByZonalCommodity(string $on = null, string $search = null)
    {
        try {
            return ZonalCommodity::query()
                ->select('ID', 'CommodityID')
                ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                    $query->where($on, '=', "{$search}");
                })
                ->with('Commodity.Phenophase:ID,Name')
                ->get();
        } catch (Exception $e) {
            throw $e;
        }
    }

     /**
     * Find all Regions
     * @param string $on The field to search
     * @param string $search The value to search
     */
    public function allStressByZonalCommodityAndStressType(int $zonalCommodityId = null, int $stressType = null)
    {
         try {
         /*return ZonalCommodity::query()
           ->select('ID','CommodityID')
           ->where('ID',$zonalCommodityId)
            ->with('CommodityStress:ID,CommodityID,StressID','CommodityStress.Stress:ID,Name,StressTypeID')
            ->whereHas('CommodityStress.Stress', function ($query) use ($stressType) {
                $query->where('StressTypeID', $stressType);
            })
           // ->with('CommodityStress.Stress:ID,Name,StressTypeID')
            ->orderBy('ID', 'asc')
            ->get();*/

           /*dd($stressData);
            $data = [];
            // Access the retrieved stress information
            foreach ($stressData as $item) {
                $data[] = $item; // Access the stress name
                // You can also access other properties of the stress or related tables if needed
            }
           // return $data;
            dd($data);*/
            $stressData = ZonalCommodity::query()
           ->select('ID','CommodityID')
           ->where('ID',$zonalCommodityId)
            ->with('Commodity.CommodityStress.Stress',function( $query ) use ($stressType){
                $query->where('StressTypeID', '=', '2');
                //$query->with('Stress:ID,Name');
            })
            //->with('Commodity.CommodityStress.Stress:ID,Name,StressTypeID')
            ->get();

            //dd($stressData);
            $data = [];
            foreach ($stressData as $item) {
                // if ($item->Commodity->CommodityStress->Stress->relation) {
                    dump($item->Commodity->CommodityStress);
                // }
                //if(isset($item->Commodity->CommodityStress->Stress)){
                    // $data[] = $item->Commodity->CommodityStress->stress; // Access the stress name
                //}
                // You can also access other properties of the stress or related tables if needed
            }
            dd("Here");
           // return $data;

           dd($data);
            foreach ($data as $item) {
                if($item->contains('Stress')){
                    $result[] = $item->Stress; // Access the stress name
                }
                // You can also access other properties of the stress or related tables if needed
            }
            dd($result);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all commodity agrochemical and its name as per condition for dropdown listing
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function AllAgrochemicalByZonalCommodity(string $on = null, string $search = null)
    {
        try {
            return ZonalCommodity::query()
                ->select('ID', 'CommodityID')
                ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                    $query->where($on, '=', "{$search}");
                })
                ->with('AgroCommoditychemical.Agrochemical:ID,Name')
                ->get();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all commodity Meteorological Week and its name as per condition for dropdown listing
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function allZonalMeteorologicalWeekByZonalCommodity(string $fieldName = null, string $on = null, string $search = null)
    {
        try {

            $sowingWeekStartValues = ZonalCommodity::where('ID', $search)
            ->groupBy('CommodityID')
            ->pluck('SowingWeekStart')
            ->unique();

            dd($sowingWeekStartValues);

            return ZonalCommodity::
            select("SowingWeekStart AS Name", 'CommodityID')
            ->where('ID', '=', "{$search}")
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
            return ZonalCommodity::getTableFields();
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
            return ZonalCommodity::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param ZonalCommodityRequest $data
     *
     * @return Array
     */
    public function add(ZonalCommodityRequest $data)
    {
        //Create a new entry in db
        try {
            ZonalCommodity::create([
                'AczID' => $data->AczID,
                'CommodityID' => $data->CommodityID,
                'SowingWeekStart' => $data->SowingWeekStart,
                'SowingWeekEnd' => $data->SowingWeekEnd,
                'HarvestWeekStart' => $data->HarvestWeekStart,
                'HarvestWeekEnd' => $data->HarvestWeekEnd,
                'NoOfDaysForHarvestMonitoring' => $data->NoOfDaysForHarvestMonitoring
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
            return ZonalCommodity::findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param ZonalCommodityRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ZonalCommodityRequest $request, int $id)
    {
        try {
            $zonalCommodity = ZonalCommodity::find($id);
            $zonalCommodity->AczID = $request->AczID;
            $zonalCommodity->CommodityID = $request->CommodityID;
            $zonalCommodity->SowingWeekStart = $request->SowingWeekStart;
            $zonalCommodity->SowingWeekEnd = $request->SowingWeekEnd;
            $zonalCommodity->HarvestWeekStart = $request->HarvestWeekStart;
            $zonalCommodity->HarvestWeekEnd = $request->HarvestWeekEnd;
            $zonalCommodity->NoOfDaysForHarvestMonitoring = $request->NoOfDaysForHarvestMonitoring;
            $zonalCommodity->save();
            return $zonalCommodity;
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
            return ZonalCommodity::whereIn("ID", $ids)
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
                return ZonalCommodity::whereIn("ID", $ids)
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
                return ZonalCommodity::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
