<?php

namespace App\Services\Farmer\FarmerLoanPurpose;

use Exception;
use App\Http\Requests\Farmer\FarmerLoanPurpose\FarmerLoanPurposeRequest;
use App\Repositories\Farmer\FarmerLoanPurpose\FarmerLoanPurposeRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Farmer\FarmerLoanPurpose\Lists\FarmerLoanPurposeListResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Farmer\FarmerLoanPurpose\Table\FarmerLoanPurposeTableCollection;


class FarmerLoanPurposeService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param FarmerLoanPurposeRepository $repository
     *
     * @return void
     */
    public function __construct(FarmerLoanPurposeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return FarmerLoanPurposeCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');
        try {
            // Return in the given API resource format
            return new FarmerLoanPurposeTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new FarmerLoanPurpose in the DB
     *
     * @param FarmerLoanPurposeRequest $data
     *
     * @return Array
     */
    public function add(FarmerLoanPurposeRequest $data )
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
     * Render the edit view for the FarmerLoanPurpose model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findFarmerLoanPurposeById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new FarmerLoanPurposeListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param FarmerLoanPurposeRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FarmerLoanPurposeRequest $request, int $id)
    {
        // Retrieve the FarmerLoanPurpose from the database
       try {
        $farmerLoanPurpose = $this->repository->findById($id);
        if ($farmerLoanPurpose) {
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

     * Update the status of an FarmerLoanPurpose record to 'rejected'.
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
     * Update the status of an FarmerLoanPurpose record to 'Active'.
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
     * Update the status of an FarmerLoanPurpose record to 'Approved'.
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
