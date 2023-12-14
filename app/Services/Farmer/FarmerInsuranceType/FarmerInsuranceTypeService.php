<?php

namespace App\Services\Farmer\FarmerInsuranceType;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Requests\Farmer\FarmerInsuranceType\FarmerInsuranceTypeRequest;
use App\Repositories\Farmer\FarmerInsuranceType\FarmerInsuranceTypeRepository;
use App\Http\Resources\Farmer\FarmerInsuranceType\Lists\FarmerInsuranceTypeListResource;
use App\Http\Resources\Farmer\FarmerInsuranceType\Lists\FarmerInsuranceTypeListCollection;
use App\Http\Resources\Farmer\FarmerInsuranceType\Table\FarmerInsuranceTypeTableCollection;


class FarmerInsuranceTypeService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param FarmerInsuranceTypeRepository $repository
     *
     * @return void
     */
    public function __construct(FarmerInsuranceTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  FarmerInsuranceTypeListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  FarmerInsuranceTypeListCollection(
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
     * @return FarmerInsuranceTypeCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');
        try {
            // Return in the given API resource format
            return new FarmerInsuranceTypeTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new FarmerInsuranceType in the DB
     *
     * @param FarmerInsuranceTypeRequest $data
     *
     * @return Array
     */
    public function add(FarmerInsuranceTypeRequest $data )
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
     * Render the edit view for the FarmerInsuranceType model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findFarmerInsuranceTypeById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new FarmerInsuranceTypeListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param FarmerInsuranceTypeRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FarmerInsuranceTypeRequest $request, int $id)
    {
        // Retrieve the FarmerInsuranceType from the database
       try {
        $farmerInsuranceType = $this->repository->findById($id);
        if ($farmerInsuranceType) {
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
        }  catch (Exception $e) {
            throw $e;
        }
    }

    /**

     * Update the status of an FarmerInsuranceType record to 'rejected'.
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
     * Update the status of an FarmerInsuranceType record to 'Active'.
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
     * Update the status of an FarmerInsuranceType record to 'Approved'.
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
