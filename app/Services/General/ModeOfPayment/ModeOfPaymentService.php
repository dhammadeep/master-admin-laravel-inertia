<?php

namespace App\Services\General\ModeOfPayment;

use Exception;
use App\Http\Requests\General\ModeOfPayment\ModeOfPaymentRequest;
use App\Repositories\General\ModeOfPayment\ModeOfPaymentRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\General\ModeOfPayment\Lists\ModeOfPaymentListResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\General\ModeOfPayment\Table\ModeOfPaymentTableCollection;


class ModeOfPaymentService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param ModeOfPaymentRepository $repository
     *
     * @return void
     */
    public function __construct(ModeOfPaymentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return ModeOfPaymentTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new ModeOfPaymentTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new ModeOfPayment in the DB
     *
     * @param ModeOfPaymentRequest $data
     *
     * @return Array
     */
    public function add(ModeOfPaymentRequest $data )
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
     * Render the edit view for the ModeOfPayment model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findModeOfPaymentById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new ModeOfPaymentListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param ModeOfPaymentRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ModeOfPaymentRequest $request, int $id)
    {
        // Retrieve the ModeOfPayment from the database
       try {
            $modeOfPayment = $this->repository->findById($id);
            if ($modeOfPayment) {
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

     * Update the status of an ModeOfPayment record to 'rejected'.
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
     * Update the status of an ModeOfPayment record to 'Active'.
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
     * Update the status of an ModeOfPayment record to 'Approved'.
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
