<?php

namespace App\Services\Zonal\VarietyZonal;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Zonal\VarietyZonal\VarietyZonalRequest;
use App\Repositories\Zonal\VarietyZonal\VarietyZonalRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Zonal\VarietyZonal\Lists\VarietyZonalListResource;
use App\Http\Resources\Zonal\VarietyZonal\Lists\VarietyZonalListCollection;
use App\Http\Resources\Zonal\VarietyZonal\Table\VarietyZonalTableCollection;


class VarietyZonalService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param VarietyZonalRepository $repository
     *
     * @return void
     */
    public function __construct(VarietyZonalRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return VarietyZonalTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
           return new VarietyZonalTableCollection($this->repository->find($on, $search, $rowsPerPage));
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
     * @return  VarietyZonalListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new VarietyZonalListCollection(
                $this->repository->all($on, $search)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new VarietyZonal in the DB
     *
     * @param VarietyZonalRequest $data
     *
     * @return Array
     */
    public function add(VarietyZonalRequest $data )
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
     * Render the edit view for the VarietyZonal model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findVarietyZonalById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new VarietyZonalListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param VarietyZonalRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VarietyZonalRequest $request, int $id)
    {
        // Retrieve the VarietyZonal from the database
       try {
            $varietyZonal = $this->repository->findById($id);
            if ($varietyZonal) {
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

     * Update the status of an VarietyZonal record to 'rejected'.
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
     * Update the status of an VarietyZonal record to 'Active'.
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
     * Update the status of an VarietyZonal record to 'Approved'.
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
