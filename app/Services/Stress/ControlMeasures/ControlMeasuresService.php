<?php

namespace App\Services\Stress\ControlMeasures;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Requests\Stress\ControlMeasures\ControlMeasuresRequest;
use App\Repositories\Stress\ControlMeasures\ControlMeasuresRepository;
use App\Http\Resources\Stress\ControlMeasures\Lists\ControlMeasuresListResource;
use App\Http\Resources\Stress\ControlMeasures\Lists\ControlMeasuresListCollection;
use App\Http\Resources\Stress\ControlMeasures\Table\ControlMeasuresTableCollection;


class ControlMeasuresService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param ControlMeasuresRepository $repository
     *
     * @return void
     */
    public function __construct(ControlMeasuresRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return ControlMeasuresTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new ControlMeasuresTableCollection($this->repository->find($on, $search, $rowsPerPage));
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
     * @return   ControlMeasuresListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        return new ControlMeasuresListCollection(
            $this->repository->all($on, $search)
        );
    }

    /**
     * Creates a new Example in the DB
     *
     * @param ControlMeasuresRequest $data
     *
     * @return Array
     */
    public function add(ControlMeasuresRequest $data)
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
     * Render the edit view for the ControlMeasures model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findControlMeasuresById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new ControlMeasuresListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param ControlMeasuresRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ControlMeasuresRequest $request, int $id)
    {
        // Retrieve the Example from the database
        try {
            $example = $this->repository->findById($id);
            if ($example) {
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

     * Update the status of an Example record to 'rejected'.
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
     * Update the status of an Example record to 'Active'.
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
     * Update the status of an Example record to 'Approved'.
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
