<?php

namespace App\Services\Farmer\FarmerVIPStatus;

use Exception;
use App\Http\Requests\Farmer\FarmerVIPStatus\FarmerVIPStatusRequest;
use App\Repositories\Farmer\FarmerVIPStatus\FarmerVIPStatusRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Farmer\FarmerVIPStatus\Lists\FarmerVIPStatusListResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Farmer\FarmerVIPStatus\Table\FarmerVIPStatusTableCollection;


class FarmerVIPStatusService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param FarmerVIPStatusRepository $repository
     *
     * @return void
     */
    public function __construct(FarmerVIPStatusRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return FarmerVIPStatusCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');
        try {
            // Return in the given API resource format
            return new FarmerVIPStatusTableCollection($this->repository->find($on, $search, $rowsPerPage));
        }  catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new FarmerVIPStatus in the DB
     *
     * @param FarmerVIPStatusRequest $data
     *
     * @return Array
     */
    public function add(FarmerVIPStatusRequest $data )
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
     * Render the edit view for the FarmerVIPStatus model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findFarmerVIPStatusById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new FarmerVIPStatusListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param FarmerVIPStatusRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FarmerVIPStatusRequest $request, int $id)
    {
        // Retrieve the FarmerVIPStatus from the database
       try {
        $farmerVIPStatus = $this->repository->findById($id);
        if ($farmerVIPStatus) {
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
        }  catch (Exception $e) {
            throw $e;
        }
    }

    /**

     * Update the status of an FarmerVIPStatus record to 'rejected'.
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
     * Update the status of an FarmerVIPStatus record to 'Active'.
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
     * Update the status of an FarmerVIPStatus record to 'Approved'.
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
