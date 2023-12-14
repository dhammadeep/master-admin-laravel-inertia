<?php

namespace App\Services\Regional\WeatherTravelTime;

use Exception;
use App\Http\Requests\Regional\WeatherTravelTime\WeatherTravelTimeRequest;
use App\Repositories\Regional\WeatherTravelTime\WeatherTravelTimeRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Regional\WeatherTravelTime\Lists\WeatherTravelTimeListResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Regional\WeatherTravelTime\Table\WeatherTravelTimeTableCollection;


class WeatherTravelTimeService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param WeatherTravelTimeRepository $repository
     *
     * @return void
     */
    public function __construct(WeatherTravelTimeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return WeatherTravelTimeTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new WeatherTravelTimeTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new WeatherTravelTime in the DB
     *
     * @param WeatherTravelTimeRequest $data
     *
     * @return Array
     */
    public function add(WeatherTravelTimeRequest $data )
    {
        try {
            return $this->repository->add($data);
        } catch (BadRequestException $e) {
            throw $e;
        } catch (NotFoundHttpException $e) {
            throw $e;
        }  catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Render the edit view for the WeatherTravelTime model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findWeatherTravelTimeById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new WeatherTravelTimeListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param WeatherTravelTimeRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WeatherTravelTimeRequest $request, int $id)
    {
        // Retrieve the WeatherTravelTime from the database
       try {
            $weatherTravelTime = $this->repository->findById($id);
            if ($weatherTravelTime) {
                return $this->repository->update($request, $id);
            }
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the dynamic table columns
     *
     * @return array
     */
    public function getTableFields(): array
    {
        try {
            return $this->repository->getTableFields();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the dynamic form elements
     *
     * @return array
     */
    public function getFormFields(): array
    {
        try {
            return $this->repository->getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**

     * Update the status of an WeatherTravelTime record to 'rejected'.
     *
     * Get the id array
     *
     * @param array id
     */
    public function updateRejectStatus(array $id)
    {
        try {
            return $this->repository->updateStatusReject(array($id));
        } catch(Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the status of an WeatherTravelTime record to 'Active'.
     *
     * Get the id array
     *
     * @param array id
     */
    public function updateFinalizeStatus(array $id)
    {
        try{
            return $this->repository->updateStatusFinalize(array($id));
        } catch(Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the status of an WeatherTravelTime record to 'Approved'.
     *
     * Get the id array
     *
     * @param array id
     */
    public function updateApproveStatus(array $id)
    {
        try{
            return $this->repository->updateStatusApprove(array($id));
        } catch(Exception $e) {
            throw $e;
        }
    }
}
