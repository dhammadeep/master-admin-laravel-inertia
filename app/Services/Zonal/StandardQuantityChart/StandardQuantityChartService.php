<?php

namespace App\Services\Zonal\StandardQuantityChart;

use Exception;
use App\Http\Requests\Zonal\StandardQuantityChart\StandardQuantityChartRequest;
use App\Repositories\Zonal\StandardQuantityChart\StandardQuantityChartRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Zonal\StandardQuantityChart\Lists\StandardQuantityChartListResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Zonal\StandardQuantityChart\Table\StandardQuantityChartTableCollection;


class StandardQuantityChartService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param StandardQuantityChartRepository $repository
     *
     * @return void
     */
    public function __construct(StandardQuantityChartRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return StandardQuantityChartTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
           return new StandardQuantityChartTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new StandardQuantityChart in the DB
     *
     * @param StandardQuantityChartRequest $data
     *
     * @return Array
     */
    public function add(StandardQuantityChartRequest $data )
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
     * Render the edit view for the StandardQuantityChart model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findStandardQuantityChartById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new StandardQuantityChartListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param StandardQuantityChartRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StandardQuantityChartRequest $request, int $id)
    {
        // Retrieve the StandardQuantityChart from the database
       try {
            $standardQuantityChart = $this->repository->findById($id);
            if ($standardQuantityChart) {
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

     * Update the status of an StandardQuantityChart record to 'rejected'.
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
     * Update the status of an StandardQuantityChart record to 'Active'.
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
     * Update the status of an StandardQuantityChart record to 'Approved'.
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
