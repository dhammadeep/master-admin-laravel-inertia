<?php

namespace App\Services\General\Uom;

use Exception;
use App\Http\Requests\General\Uom\UomRequest;
use App\Repositories\General\Uom\UomRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\General\Uom\Lists\UomListResource;
use App\Http\Resources\General\Uom\Lists\UomListCollection;
use App\Http\Resources\General\Uom\Table\UomTableCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;


class UomService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param UomRepository $repository
     *
     * @return void
     */
    public function __construct(UomRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return UomTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new UomTableCollection($this->repository->find($on, $search, $rowsPerPage));
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
            return new UomListCollection(
                $this->repository->all($on, $search)
            );
        } catch(Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new Uom in the DB
     *
     * @param UomRequest $data
     *
     * @return Array
     */
    public function add(UomRequest $data )
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
     * Render the edit view for the Uom model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findUomById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new UomListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param UomRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UomRequest $request, int $id)
    {
        // Retrieve the Uom from the database
       try {
            $uom = $this->repository->findById($id);
            if ($uom) {
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
        try{
            return $this->repository->getTableFields();
        } catch(Exception $e) {
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
        try{
            return $this->repository->getFormFields();
        } catch(Exception $e) {
            throw $e;
        }
    }

    /**

     * Update the status of an Uom record to 'rejected'.
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
     * Update the status of an Uom record to 'Active'.
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
     * Update the status of an Uom record to 'Approved'.
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
