<?php

namespace App\Repositories\Zonal\FavourableWeather;

use Exception;
use App\Models\Zonal\FavourableWeather;
use App\Http\Requests\Zonal\FavourableWeather\FavourableWeatherRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Zonal\FavourableWeather\RepoInterface\FavourableWeatherRepoInterface;

class FavourableWeatherRepository implements FavourableWeatherRepoInterface
{
    /**
     * Find FavourableWeathers and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return FavourableWeather::query()
            ->select(
                'ID',
                'ZonalCommodityID',
                'PhenophaseID',
                'WeatherParameterID',
                'SpecificationAverage',
                'SpecificationLower',
                'SpecificationUpper',
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
            ->with('ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
           'ZonalCommodity.Commodity:ID,Name',
           'ZonalCommodity.Acz:ID,Name,StateCode',
           'ZonalCommodity.Acz.State:ID,Name',
           'Phenophase:ID,Name',
           'WeatherParams:ID,Name')
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
            return FavourableWeather::getTableFields();
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
            return FavourableWeather::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param FavourableWeatherRequest $data
     *
     * @return Array
     */
    public function add(FavourableWeatherRequest $data)
    {
        //Create a new entry in db
        try {
            FavourableWeather::create([
                'ZonalCommodityID' => $data->ZonalCommodityID,
                'PhenophaseID' => $data->PhenophaseID,
                'WeatherParameterID' => $data->WeatherParameterID,
                'SpecificationAverage' => $data->SpecificationAverage,
                'SpecificationLower' => $data->SpecificationLower,
                'SpecificationUpper' => $data->SpecificationUpper,
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
            return FavourableWeather::select(
                'ID',
                'ZonalCommodityID',
                'PhenophaseID',
                'WeatherParameterID',
                'SpecificationAverage',
                'SpecificationLower',
                'SpecificationUpper',
                'Status'
            )->with('ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
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
     * @param FavourableWeatherRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FavourableWeatherRequest $request, int $id)
    {
        try {
            $favourableWeather = FavourableWeather::find($id);
            $favourableWeather->ZonalCommodityID = $request->ZonalCommodityID;
            $favourableWeather->PhenophaseID = $request->PhenophaseID;
            $favourableWeather->WeatherParameterID = $request->WeatherParameterID;
            $favourableWeather->SpecificationAverage = $request->SpecificationAverage;
            $favourableWeather->SpecificationLower = $request->SpecificationLower;
            $favourableWeather->SpecificationUpper = $request->SpecificationUpper;
            $favourableWeather->save();
            return $favourableWeather;
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
            return FavourableWeather::whereIn("ID", $ids)
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
                return FavourableWeather::whereIn("ID", $ids)
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
                return FavourableWeather::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
