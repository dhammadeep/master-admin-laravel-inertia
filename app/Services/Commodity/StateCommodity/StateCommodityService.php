<?php

namespace App\Services\Commodity\StateCommodity;

use Exception;
use App\Http\Requests\Commodity\StateCommodity\StateCommodityRequest;
use App\Repositories\Commodity\StateCommodity\StateCommodityRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Commodity\StateCommodity\Lists\StateCommodityListResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Commodity\StateCommodity\Table\StateCommodityTableCollection;


class StateCommodityService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param StateCommodityRepository $repository
     *
     * @return void
     */
    public function __construct(StateCommodityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return StateCommodityCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');
        try {
            // Return in the given API resource format
            return new StateCommodityTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new StateCommodity in the DB
     *
     * @param StateCommodityRequest $data
     *
     * @return Array
     */
    public function add(StateCommodityRequest $data )
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
     * Render the edit view for the StateCommodity model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findStateCommodityById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new StateCommodityListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param StateCommodityRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StateCommodityRequest $request, int $id)
    {
        // Retrieve the StateCommodity from the database
       try {
        $stateCommodity = $this->repository->findById($id);
        if ($stateCommodity) {
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

     * Update the status of an StateCommodity record to 'rejected'.
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
     * Update the status of an StateCommodity record to 'Active'.
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
     * Update the status of an StateCommodity record to 'Approved'.
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
