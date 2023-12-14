<?php

namespace App\Services\General\WeatherParams;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\General\WeatherParams\WeatherParamsRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repositories\General\WeatherParams\WeatherParamsRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\General\WeatherParams\Lists\WeatherParamsListResource;
use App\Http\Resources\General\WeatherParams\Lists\WeatherParamsListCollection;
use App\Http\Resources\General\WeatherParams\Table\WeatherParamsTableCollection;


class WeatherParamsService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param WeatherParamsRepository $repository
     *
     * @return void
     */
    public function __construct(WeatherParamsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return WeatherParamsTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new WeatherParamsTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

     /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  UomListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try{
            return new WeatherParamsListCollection(
                $this->repository->all($on, $search)
            );
        } catch(Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new WeatherParams in the DB
     *
     * @param WeatherParamsRequest $data
     *
     * @return Array
     */
    public function add(WeatherParamsRequest $data )
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
     * Render the edit view for the WeatherParams model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findWeatherParamsById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new WeatherParamsListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param WeatherParamsRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WeatherParamsRequest $request, int $id)
    {
        // Retrieve the WeatherParams from the database
       try {
            $weatherParams = $this->repository->findById($id);
            if ($weatherParams) {
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

     * Update the status of an WeatherParams record to 'rejected'.
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
     * Update the status of an WeatherParams record to 'Active'.
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
     * Update the status of an WeatherParams record to 'Approved'.
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
