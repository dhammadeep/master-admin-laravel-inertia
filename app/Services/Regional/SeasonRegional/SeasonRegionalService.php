<?php

namespace App\Services\Regional\SeasonRegional;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Requests\Regional\SeasonRegional\SeasonRegionalRequest;
use App\Repositories\Regional\SeasonRegional\SeasonRegionalRepository;
use App\Http\Resources\Regional\SeasonRegional\Lists\SeasonRegionalListResource;
use App\Http\Resources\Regional\SeasonRegional\Lists\SeasonRegionalListCollection;
use App\Http\Resources\Regional\SeasonRegional\Table\SeasonRegionalTableCollection;


class SeasonRegionalService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param SeasonRegionalRepository $repository
     *
     * @return void
     */
    public function __construct(SeasonRegionalRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return SeasonRegionalTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new SeasonRegionalTableCollection($this->repository->find($on, $search, $rowsPerPage));
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
     * @return  SeasonRegionalListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new SeasonRegionalListCollection(
                $this->repository->all($on, $search)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new SeasonRegional in the DB
     *
     * @param SeasonRegionalRequest $data
     *
     * @return Array
     */
    public function add(SeasonRegionalRequest $data)
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
     * Render the edit view for the SeasonRegional model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findSeasonRegionalById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new SeasonRegionalListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param SeasonRegionalRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SeasonRegionalRequest $request, int $id)
    {
        // Retrieve the SeasonRegional from the database
        try {
            $seasonRegional = $this->repository->findById($id);
            if ($seasonRegional) {
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

     * Update the status of an SeasonRegional record to 'rejected'.
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
     * Update the status of an SeasonRegional record to 'Active'.
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
     * Update the status of an SeasonRegional record to 'Approved'.
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
