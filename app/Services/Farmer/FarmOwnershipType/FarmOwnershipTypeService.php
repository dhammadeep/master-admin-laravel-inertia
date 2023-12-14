<?php

namespace App\Services\Farmer\FarmOwnershipType;

use Exception;
use App\Http\Requests\Farmer\FarmOwnershipType\FarmOwnershipTypeRequest;
use App\Repositories\Farmer\FarmOwnershipType\FarmOwnershipTypeRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Farmer\FarmOwnershipType\Lists\FarmOwnershipTypeListResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Farmer\FarmOwnershipType\Table\FarmOwnershipTypeTableCollection;


class FarmOwnershipTypeService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param FarmOwnershipTypeRepository $repository
     *
     * @return void
     */
    public function __construct(FarmOwnershipTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return FarmOwnershipTypeCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');
        try {
            // Return in the given API resource format
            return new FarmOwnershipTypeTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new FarmOwnershipType in the DB
     *
     * @param FarmOwnershipTypeRequest $data
     *
     * @return Array
     */
    public function add(FarmOwnershipTypeRequest $data )
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
     * Render the edit view for the FarmOwnershipType model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findFarmOwnershipTypeById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new FarmOwnershipTypeListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param FarmOwnershipTypeRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FarmOwnershipTypeRequest $request, int $id)
    {
        // Retrieve the FarmOwnershipType from the database
       try {
        $farmOwnershipType = $this->repository->findById($id);
        if ($farmOwnershipType) {
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
        }  catch (Exception $e) {
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

     * Update the status of an FarmOwnershipType record to 'rejected'.
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
     * Update the status of an FarmOwnershipType record to 'Active'.
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
     * Update the status of an FarmOwnershipType record to 'Approved'.
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
