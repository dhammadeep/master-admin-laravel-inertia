<?php

namespace App\Services\Farmer\FarmerMobileType;

use Exception;
use App\Http\Requests\Farmer\FarmerMobileType\FarmerMobileTypeRequest;
use App\Repositories\Farmer\FarmerMobileType\FarmerMobileTypeRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Farmer\FarmerMobileType\Lists\FarmerMobileTypeListResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Farmer\FarmerMobileType\Table\FarmerMobileTypeTableCollection;


class FarmerMobileTypeService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param FarmerMobileTypeRepository $repository
     *
     * @return void
     */
    public function __construct(FarmerMobileTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return FarmerMobileTypeCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');
        try {
            // Return in the given API resource format
            return new FarmerMobileTypeTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new FarmerMobileType in the DB
     *
     * @param FarmerMobileTypeRequest $data
     *
     * @return Array
     */
    public function add(FarmerMobileTypeRequest $data )
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
     * Render the edit view for the FarmerMobileType model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findFarmerMobileTypeById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new FarmerMobileTypeListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param FarmerMobileTypeRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FarmerMobileTypeRequest $request, int $id)
    {
        // Retrieve the FarmerMobileType from the database
       try {
        $farmerMobileType = $this->repository->findById($id);
        if ($farmerMobileType) {
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

     * Update the status of an FarmerMobileType record to 'rejected'.
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
     * Update the status of an FarmerMobileType record to 'Active'.
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
     * Update the status of an FarmerMobileType record to 'Approved'.
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
