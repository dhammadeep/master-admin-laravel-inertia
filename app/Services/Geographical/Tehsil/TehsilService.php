<?php

namespace App\Services\Geographical\Tehsil;

use Exception;
use App\Http\Requests\Geographical\Tehsil\TehsilRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Geographical\Tehsil\TehsilRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Geographical\Tehsil\Lists\TehsilListResource;
use App\Http\Resources\Geographical\Tehsil\Lists\TehsilListCollection;
use App\Http\Resources\Geographical\Tehsil\Table\TehsilTableCollection;


class TehsilService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param TehsilRepository $repository
     *
     * @return void
     */
    public function __construct(TehsilRepository $repository)
    {
        $this->repository = $repository;
    }

     /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  TehsilListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  TehsilListCollection(
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
     * @return TehsilTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new TehsilTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Creates a new Tehsil in the DB
     *
     * @param TehsilRequest $data
     *
     * @return Array
     */
    public function add(TehsilRequest $data )
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
     * Render the edit view for the Tehsil model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findTehsilById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new TehsilListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param TehsilRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TehsilRequest $request, int $id)
    {
        // Retrieve the Tehsil from the database
       try {
            $tehsil = $this->repository->findById($id);
            if ($tehsil) {
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

     * Update the status of an Tehsil record to 'rejected'.
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
     * Update the status of an Tehsil record to 'Active'.
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
     * Update the status of an Tehsil record to 'Approved'.
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
