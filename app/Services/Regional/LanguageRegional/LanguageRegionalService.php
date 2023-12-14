<?php

namespace App\Services\Regional\LanguageRegional;

use Exception;
use App\Http\Requests\Regional\LanguageRegional\LanguageRegionalRequest;
use App\Repositories\Regional\LanguageRegional\LanguageRegionalRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Regional\LanguageRegional\Lists\LanguageRegionalListResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Regional\LanguageRegional\Table\LanguageRegionalTableCollection;


class LanguageRegionalService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param LanguageRegionalRepository $repository
     *
     * @return void
     */
    public function __construct(LanguageRegionalRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return LanguageRegionalTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new LanguageRegionalTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Creates a new LanguageRegional in the DB
     *
     * @param LanguageRegionalRequest $data
     *
     * @return Array
     */
    public function add(LanguageRegionalRequest $data )
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
     * Render the edit view for the LanguageRegional model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findLanguageRegionalById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new LanguageRegionalListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param LanguageRegionalRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LanguageRegionalRequest $request, int $id)
    {
        // Retrieve the LanguageRegional from the database
       try {
            $languageRegional = $this->repository->findById($id);
            if ($languageRegional) {
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

     * Update the status of an LanguageRegional record to 'rejected'.
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
     * Update the status of an LanguageRegional record to 'Active'.
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
     * Update the status of an LanguageRegional record to 'Approved'.
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
