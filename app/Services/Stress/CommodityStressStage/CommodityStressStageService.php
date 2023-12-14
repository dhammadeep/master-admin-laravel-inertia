<?php

namespace App\Services\Stress\CommodityStressStage;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Requests\Stress\CommodityStressStage\CommodityStressStageRequest;
use App\Repositories\Stress\CommodityStressStage\CommodityStressStageRepository;
use App\Http\Resources\Stress\CommodityStressStage\Lists\CommodityStressStageListResource;
use App\Http\Resources\Stress\CommodityStressStage\Lists\CommodityStressStageListCollection;
use App\Http\Resources\Stress\CommodityStressStage\Table\CommodityStressStageTableCollection;


class CommodityStressStageService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param CommodityStressStageRepository $repository
     *
     * @return void
     */
    public function __construct(CommodityStressStageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return CommodityStressStageTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new CommodityStressStageTableCollection($this->repository->find($on, $search, $rowsPerPage));
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
     * @return  CommodityStressStageListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new CommodityStressStageListCollection(
                $this->repository->all($on, $search)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new CommodityStressStage in the DB
     *
     * @param CommodityStressStageRequest $data
     *
     * @return Array
     */
    public function add(CommodityStressStageRequest $data)
    {
        try {
            return $this->repository->add($data);
        } catch (BadRequestException $e) {
            throw $e;
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Render the edit view for the CommodityStressStage model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findCommodityStressStageById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new CommodityStressStageListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param CommodityStressStageRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommodityStressStageRequest $request, int $id)
    {
        // Retrieve the CommodityStressStage from the database
        try {
            $commodityStressStage = $this->repository->findById($id);
            if ($commodityStressStage) {
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

     * Update the status of an CommodityStressStage record to 'rejected'.
     *
     * Get the id array
     *
     * @param array id
     */
    public function updateRejectStatus(array $id)
    {
        try {
            return $this->repository->updateStatusReject(array($id));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the status of an CommodityStressStage record to 'Active'.
     *
     * Get the id array
     *
     * @param array id
     */
    public function updateFinalizeStatus(array $id)
    {
        try {
            return $this->repository->updateStatusFinalize(array($id));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the status of an CommodityStressStage record to 'Approved'.
     *
     * Get the id array
     *
     * @param array id
     */
    public function updateApproveStatus(array $id)
    {
        try {
            return $this->repository->updateStatusApprove(array($id));
        } catch (Exception $e) {
            throw $e;
        }
    }
}
