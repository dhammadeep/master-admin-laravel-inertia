<?php

namespace App\Services\Zonal\ZonalCommodity;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Stress\Stress\Lists\StressListCollection;
use App\Http\Requests\Zonal\ZonalCommodity\ZonalCommodityRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repositories\Zonal\ZonalCommodity\ZonalCommodityRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Phenophase\Phenophase\Lists\PhenophaseListCollection;
use App\Http\Resources\Zonal\ZonalCommodity\Lists\ZonalCommodityListResource;
use App\Http\Resources\Zonal\ZonalCommodity\Lists\ZonalCommodityListCollection;
use App\Http\Resources\Zonal\ZonalCommodity\Table\ZonalCommodityTableCollection;
use App\Http\Resources\Zonal\ZonalCommodity\Lists\ZonalMeteorologicalWeekListCollection;


class ZonalCommodityService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param ZonalCommodityRepository $repository
     *
     * @return void
     */
    public function __construct(ZonalCommodityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return ZonalCommodityTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
           return new ZonalCommodityTableCollection($this->repository->find($on, $search, $rowsPerPage));
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
     * @return  ZonalCommodityListCollection
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
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  ZonalPhenophaseListCollection
     */
    public function getAllPhenophaseRecordsByZonalCommodity($on = "", $search = "")
    {
        try {
            return new ZonalPhenophaseListCollection(
                $this->repository->allPhenophaseByZonalCommodity($on, $search)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Return all stress data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  ZonalStressListCollection
     */
    public function getStressByZonalCommodityAndStressType($on = "", $search = "")
    {
        dd( $this->repository->allStressByZonalCommodityAndStressType($on, $search));
        try {
            return new  ZonalStressListCollection(
                $this->repository->allStressByZonalCommodityAndStressType($on, $search)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Return all agrochemical data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  ZonalAgrochemicalListCollection
     */
    public function getAgrochemicalByZonalCommodity($on = "", $search = "")
    {
        try {
            return new  ZonalAgrochemicalListCollection(
                $this->repository->allAgrochemicalByZonalCommodity($on, $search)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Return all agrochemical data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  ZonalMeteorologicalListCollection
     */
    public function getAllMeteorologicalWeekByZonalCommodity($fieldName, $on = "", $search = "")
    {
        try {
            return new  ZonalMeteorologicalWeekListCollection(
                $this->repository->allZonalMeteorologicalWeekByZonalCommodity($fieldName, $on, $search)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }





    /**
     * Creates a new ZonalCommodity in the DB
     *
     * @param ZonalCommodityRequest $data
     *
     * @return Array
     */
    public function add(ZonalCommodityRequest $data )
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
     * Render the edit view for the ZonalCommodity model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findZonalCommodityById(int $id)
    {
        try {
            // dd($this->repository->findById($id));
            return collect(new ZonalCommodityListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param ZonalCommodityRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ZonalCommodityRequest $request, int $id)
    {
        // Retrieve the ZonalCommodity from the database
       try {
            $zonalCommodity = $this->repository->findById($id);
            if ($zonalCommodity) {
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

     * Update the status of an ZonalCommodity record to 'rejected'.
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
     * Update the status of an ZonalCommodity record to 'Active'.
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
     * Update the status of an ZonalCommodity record to 'Approved'.
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
