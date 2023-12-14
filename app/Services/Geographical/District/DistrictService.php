<?php

namespace App\Services\Geographical\District;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Geographical\District\DistrictRequest;
use App\Repositories\Geographical\District\DistrictRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Geographical\District\Lists\DistrictListResource;
use App\Http\Resources\Geographical\District\Lists\DistrictListCollection;
use App\Http\Resources\Geographical\District\Table\DistrictTableCollection;


class DistrictService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param DistrictRepository $repository
     *
     * @return void
     */
    public function __construct(DistrictRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  DistrictListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  DistrictListCollection(
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
     * @return DistrictTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new DistrictTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new District in the DB
     *
     * @param DistrictRequest $data
     *
     * @return Array
     */
    public function add(DistrictRequest $data )
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
     * Render the edit view for the District model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findDistrictById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new DistrictListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param DistrictRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DistrictRequest $request, int $id)
    {
        // Retrieve the District from the database
       try {
            $district = $this->repository->findById($id);
            if ($district) {
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

     * Update the status of an District record to 'rejected'.
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
     * Update the status of an District record to 'Active'.
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
     * Update the status of an District record to 'Approved'.
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
