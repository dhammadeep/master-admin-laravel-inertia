<?php

namespace App\Services\Commodity\HSNCode;

use Exception;
use App\Http\Requests\Commodity\HSNCode\HSNCodeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Commodity\HSNCode\HSNCodeRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Resources\Commodity\HSNCode\Lists\HSNCodeListResource;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Commodity\HSNCode\Lists\HSNCodeListCollection;
use App\Http\Resources\Commodity\HSNCode\Table\HSNCodeTableCollection;


class HSNCodeService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param HSNCodeRepository $repository
     *
     * @return void
     */
    public function __construct(HSNCodeRepository $repository)
    {
        $this->repository = $repository;
    }

     /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  HSNCodeListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  HSNCodeListCollection(
                $this->repository->all($on, $search)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return HSNCodeCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');
        try {
            // Return in the given API resource format
            return new HSNCodeTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new HSNCode in the DB
     *
     * @param HSNCodeRequest $data
     *
     * @return Array
     */
    public function add(HSNCodeRequest $data )
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
     * Render the edit view for the HSNCode model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findHSNCodeById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new HSNCodeListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param HSNCodeRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HSNCodeRequest $request, int $id)
    {
        // Retrieve the HSNCode from the database
       try {
        $hsnCode = $this->repository->findById($id);
        if ($hsnCode) {
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

     * Update the status of an HSNCode record to 'rejected'.
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
     * Update the status of an HSNCode record to 'Active'.
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
     * Update the status of an HSNCode record to 'Approved'.
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
