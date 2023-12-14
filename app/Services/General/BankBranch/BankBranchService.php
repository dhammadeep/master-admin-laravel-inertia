<?php

namespace App\Services\General\BankBranch;

use Exception;
use App\Http\Requests\General\BankBranch\BankBranchRequest;
use App\Repositories\General\BankBranch\BankBranchRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\General\BankBranch\Lists\BankBranchListResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\General\BankBranch\Table\BankBranchTableCollection;


class BankBranchService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param BankBranchRepository $repository
     *
     * @return void
     */
    public function __construct(BankBranchRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return BankBranchTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new BankBranchTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new BankBranch in the DB
     *
     * @param BankBranchRequest $data
     *
     * @return Array
     */
    public function add(BankBranchRequest $data )
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
     * Render the edit view for the BankBranch model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findBankBranchById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new BankBranchListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param BankBranchRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BankBranchRequest $request, int $id)
    {
        // Retrieve the BankBranch from the database
       try {
            $bankBranch = $this->repository->findById($id);
            if ($bankBranch) {
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

     * Update the status of an BankBranch record to 'rejected'.
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
     * Update the status of an BankBranch record to 'Active'.
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
     * Update the status of an BankBranch record to 'Approved'.
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
