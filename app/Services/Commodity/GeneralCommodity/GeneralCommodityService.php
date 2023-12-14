<?php

namespace App\Services\Commodity\GeneralCommodity;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Requests\Commodity\GeneralCommodity\GeneralCommodityRequest;
use App\Repositories\Commodity\GeneralCommodity\GeneralCommodityRepository;
use App\Http\Resources\Commodity\GeneralCommodity\Lists\GeneralCommodityListResource;
use App\Http\Resources\Commodity\GeneralCommodity\Lists\GeneralCommodityListCollection;
use App\Http\Resources\Commodity\GeneralCommodity\Table\GeneralCommodityTableCollection;


class GeneralCommodityService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param GeneralCommodityRepository $repository
     *
     * @return void
     */
    public function __construct(GeneralCommodityRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  GeneralCommodityListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  GeneralCommodityListCollection(
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
     * @return GeneralCommodityCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');
        try {
            // Return in the given API resource format
            return new GeneralCommodityTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new GeneralCommodity in the DB
     *
     * @param GeneralCommodityRequest $data
     *
     * @return Array
     */
    public function add(GeneralCommodityRequest $data )
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
     * Render the edit view for the GeneralCommodity model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findGeneralCommodityById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new GeneralCommodityListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param GeneralCommodityRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GeneralCommodityRequest $request, int $id)
    {
        // Retrieve the GeneralCommodity from the database
       try {
        $generalCommodity = $this->repository->findById($id);
        if ($generalCommodity) {
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

     * Update the status of an GeneralCommodity record to 'rejected'.
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
     * Update the status of an GeneralCommodity record to 'Active'.
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
     * Update the status of an GeneralCommodity record to 'Approved'.
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
