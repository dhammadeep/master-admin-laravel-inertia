<?php

namespace App\Services\Commodity\PlantPart;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Commodity\PlantPart\PlantPartRequest;
use App\Repositories\Commodity\PlantPart\PlantPartRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Commodity\PlantPart\Lists\PlantPartListResource;
use App\Http\Resources\Commodity\PlantPart\Table\PlantPartTableCollection;
use App\Http\Resources\Commodity\CommodityPlantPart\Lists\CommodityPlantPartListCollection;


class PlantPartService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param PlantPartRepository $repository
     *
     * @return void
     */
    public function __construct(PlantPartRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  CommodityPlantPartListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  CommodityPlantPartListCollection(
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
     * @return PlantPartCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        try {
            // Return in the given API resource format
            return new PlantPartTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new PlantPart in the DB
     *
     * @param PlantPartRequest $data
     *
     * @return Array
     */
    public function add(PlantPartRequest $data )
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
     * Render the edit view for the PlantPart model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findPlantPartById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new PlantPartListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param PlantPartRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PlantPartRequest $request, int $id)
    {
        // Retrieve the PlantPart from the database
       try {
        $plantPart = $this->repository->findById($id);
        if ($plantPart) {
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

     * Update the status of an PlantPart record to 'rejected'.
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
     * Update the status of an PlantPart record to 'Active'.
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
     * Update the status of an PlantPart record to 'Approved'.
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
