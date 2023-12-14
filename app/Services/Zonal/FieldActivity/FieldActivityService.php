<?php

namespace App\Services\Zonal\FieldActivity;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Zonal\FieldActivity\FieldActivityRequest;
use App\Repositories\Zonal\FieldActivity\FieldActivityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Zonal\FieldActivity\Lists\FieldActivityListResource;
use App\Http\Resources\Zonal\FieldActivity\Lists\FieldActivityListCollection;
use App\Http\Resources\Zonal\FieldActivity\Table\FieldActivityTableCollection;


class FieldActivityService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param FieldActivityRepository $repository
     *
     * @return void
     */
    public function __construct(FieldActivityRepository $repository)
    {
        $this->repository = $repository;
    }
/**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  ConduciveWeatherListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  FieldActivityListCollection(
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
     * @return FieldActivityTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
           return new FieldActivityTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new FieldActivity in the DB
     *
     * @param FieldActivityRequest $data
     *
     * @return Array
     */
    public function add(FieldActivityRequest $data )
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
     * Render the edit view for the FieldActivity model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findFieldActivityById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new FieldActivityListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param FieldActivityRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FieldActivityRequest $request, int $id)
    {
        // Retrieve the FieldActivity from the database
       try {
            $fieldActivity = $this->repository->findById($id);
            if ($fieldActivity) {
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

     * Update the status of an FieldActivity record to 'rejected'.
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
     * Update the status of an FieldActivity record to 'Active'.
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
     * Update the status of an FieldActivity record to 'Approved'.
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
