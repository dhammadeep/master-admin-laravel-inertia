<?php

namespace App\Services\Geographical\TehsilAlias;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Requests\Geographical\TehsilAlias\TehsilAliasRequest;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Repositories\Geographical\TehsilAlias\TehsilAliasRepository;
use App\Http\Resources\Geographical\TehsilAlias\Lists\TehsilAliasListResource;
use App\Http\Resources\Geographical\TehsilAlias\Lists\TehsilAliasListCollection;
use App\Http\Resources\Geographical\TehsilAlias\Table\TehsilAliasTableCollection;


class TehsilAliasService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param TehsilAliasRepository $repository
     *
     * @return void
     */
    public function __construct(TehsilAliasRepository $repository)
    {
        $this->repository = $repository;
    }

      /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  TehsilAliasListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  TehsilAliasListCollection(
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
     * @return TehsilAliasTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new TehsilAliasTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Creates a new TehsilAlias in the DB
     *
     * @param TehsilAliasRequest $data
     *
     * @return Array
     */
    public function add(TehsilAliasRequest $data )
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
     * Render the edit view for the TehsilAlias model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findTehsilAliasById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new TehsilAliasListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param TehsilAliasRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TehsilAliasRequest $request, int $id)
    {
        // Retrieve the TehsilAlias from the database
       try {
            $tehsilAlias = $this->repository->findById($id);
            if ($tehsilAlias) {
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

     * Update the status of an TehsilAlias record to 'rejected'.
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
     * Update the status of an TehsilAlias record to 'Active'.
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
     * Update the status of an TehsilAlias record to 'Approved'.
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
