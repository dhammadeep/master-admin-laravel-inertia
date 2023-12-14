<?php

namespace App\Services\Agriculture\AgricultureFertilizer;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Requests\Agriculture\AgricultureFertilizer\AgricultureFertilizerRequest;
use App\Repositories\Agriculture\AgricultureFertilizer\AgricultureFertilizerRepository;
use App\Http\Resources\Agriculture\AgricultureFertilizer\Lists\AgricultureFertilizerListResource;
use App\Http\Resources\Agriculture\AgricultureFertilizer\Lists\AgricultureFertilizerListCollection;
use App\Http\Resources\Agriculture\AgricultureFertilizer\Table\AgricultureFertilizerTableCollection;


class AgricultureFertilizerService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param AgricultureFertilizerRepository $repository
     *
     * @return void
     */
    public function __construct(AgricultureFertilizerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  AgricultureFertilizerListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        return new  AgricultureFertilizerListCollection(
            $this->repository->all($on, $search, 100)
        );
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return AgricultureFertilizerTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
           return new AgricultureFertilizerTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new AgricultureFertilizer in the DB
     *
     * @param AgricultureFertilizerRequest $data
     *
     * @return Array
     */
    public function add(AgricultureFertilizerRequest $data )
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
     * Render the edit view for the AgricultureFertilizer model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findAgricultureFertilizerById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new AgricultureFertilizerListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param AgricultureFertilizerRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AgricultureFertilizerRequest $request, int $id)
    {
        // Retrieve the AgricultureFertilizer from the database
       try {
            $agricultureFertilizer = $this->repository->findById($id);
            if ($agricultureFertilizer) {
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

     * Update the status of an AgricultureFertilizer record to 'rejected'.
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
     * Update the status of an AgricultureFertilizer record to 'Active'.
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
     * Update the status of an AgricultureFertilizer record to 'Approved'.
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
