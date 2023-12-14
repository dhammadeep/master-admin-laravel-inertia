<?php

namespace App\Repositories\Zonal\ConduciveWeather;

use Exception;
use App\Models\Zonal\ConduciveWeather;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Zonal\ConduciveWeather\ConduciveWeatherRequest;
use App\Repositories\Zonal\ConduciveWeather\RepoInterface\ConduciveWeatherRepoInterface;

class ConduciveWeatherRepository implements ConduciveWeatherRepoInterface
{
    /**
     * Find ConduciveWeathers and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return ConduciveWeather::query()
            ->select('ID',
            'ZonalCommodityID',
            'StressID',
            'WeatherParameterID',
            'Lower',
            'Upper',
            'ConduciveDuration',
            'RelaxingDuration',
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
            ->with(
                    'ZonalCommodity:ID,AczID,CommodityID,SowingWeekStart,SowingWeekEnd',
                    'ZonalCommodity.Commodity:ID,Name',
                    'ZonalCommodity.Acz:ID,Name,StateCode',
                    'ZonalCommodity.Acz.State:ID,Name',
                    'Stress:ID,Name,StressTypeID',
                    'Stress.StressType:ID,Name',
                    'WeatherParameter:ID,Name'
                )
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find all Conducive Weather
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
         try {
            return ConduciveWeather::query()
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
            return ConduciveWeather::getTableFields();
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
            return ConduciveWeather::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param ConduciveWeatherRequest $data
     *
     * @return Array
     */
    public function add(ConduciveWeatherRequest $data)
    {
        //Create a new entry in db
        try {
            ConduciveWeather::create([
                'ZonalCommodityID' => $data->ZonalCommodityID,
                'StressID' => $data->StressID,
                'WeatherParameterID' => $data->WeatherParameterID,
                'Lower' => $data->Lower,
                'Upper' => $data->Upper,
                'ConduciveDuration' => $data->ConduciveDuration,
                'RelaxingDuration' => $data->RelaxingDuration,
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
            return ConduciveWeather::select('ID','ZonalCommodityID','StressID','WeatherParameterID','Lower','Upper','ConduciveDuration','RelaxingDuration')
            ->with(
                'ZonalCommodity:ID,AczID',
                'ZonalCommodity.Acz:ID,Name,StateCode',
                'ZonalCommodity.Acz.State:ID,Name'
                )
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param ConduciveWeatherRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ConduciveWeatherRequest $request, int $id)
    {
        try {
            $conduciveWeather = ConduciveWeather::find($id);
            $conduciveWeather->ZonalCommodityID = $request->ZonalCommodityID;
            $conduciveWeather->StressID = $request->StressID;
            $conduciveWeather->WeatherParameterID = $request->WeatherParameterID;
            $conduciveWeather->Lower = $request->Lower;
            $conduciveWeather->Upper = $request->Upper;
            $conduciveWeather->ConduciveDuration = $request->ConduciveDuration;
            $conduciveWeather->RelaxingDuration = $request->RelaxingDuration;
            $conduciveWeather->save();
            return $conduciveWeather;
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
            return ConduciveWeather::whereIn("ID", $ids)
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
                return ConduciveWeather::whereIn("ID", $ids)
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
                return ConduciveWeather::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
