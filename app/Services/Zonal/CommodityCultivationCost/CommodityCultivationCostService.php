<?php

namespace App\Services\Zonal\CommodityCultivationCost;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Zonal\ZonalCommodity\Lists\ZonalCommodityListCollection;
use App\Http\Requests\Zonal\CommodityCultivationCost\CommodityCultivationCostRequest;
use App\Repositories\Zonal\CommodityCultivationCost\CommodityCultivationCostRepository;
use App\Http\Resources\Zonal\CommodityCultivationCost\Lists\CommodityCultivationCostListResource;
use App\Http\Resources\Zonal\CommodityCultivationCost\Table\CommodityCultivationCostTableCollection;


class CommodityCultivationCostService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param CommodityCultivationCostRepository $repository
     *
     * @return void
     */
    public function __construct(CommodityCultivationCostRepository $repository)
    {
        $this->repository = $repository;
    }

       /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  ZonalComodityListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  ZonalCommodityListCollection(
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
     * @return CommodityCultivationCostTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
           return new CommodityCultivationCostTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new CommodityCultivationCost in the DB
     *
     * @param CommodityCultivationCostRequest $data
     *
     * @return Array
     */
    public function add(CommodityCultivationCostRequest $data )
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
     * Render the edit view for the CommodityCultivationCost model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findCommodityCultivationCostById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new CommodityCultivationCostListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {           
            throw $e;
        } catch (Exception $e) {           
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param CommodityCultivationCostRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommodityCultivationCostRequest $request, int $id)
    {
        // Retrieve the CommodityCultivationCost from the database
       try {
            $commodityCultivationCost = $this->repository->findById($id);
            if ($commodityCultivationCost) {
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

     * Update the status of an CommodityCultivationCost record to 'rejected'.
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
     * Update the status of an CommodityCultivationCost record to 'Active'.
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
     * Update the status of an CommodityCultivationCost record to 'Approved'.
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
