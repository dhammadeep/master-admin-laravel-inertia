<?php

namespace App\Services\Geographical\DistrictAlias;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Requests\Geographical\DistrictAlias\DistrictAliasRequest;
use App\Repositories\Geographical\DistrictAlias\DistrictAliasRepository;
use App\Http\Resources\Geographical\DistrictAlias\Lists\DistrictAliasListResource;
use App\Http\Resources\Geographical\DistrictAlias\Lists\DistrictAliasListCollection;
use App\Http\Resources\Geographical\DistrictAlias\Table\DistrictAliasTableCollection;


class DistrictAliasService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param DistrictAliasRepository $repository
     *
     * @return void
     */
    public function __construct(DistrictAliasRepository $repository)
    {
        $this->repository = $repository;
    }

      /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  DistrictAliasListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  DistrictAliasListCollection(
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
     * @return DistrictAliasTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new DistrictAliasTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new DistrictAlias in the DB
     *
     * @param DistrictAliasRequest $data
     *
     * @return Array
     */
    public function add(DistrictAliasRequest $data )
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
     * Render the edit view for the DistrictAlias model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findDistrictAliasById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new DistrictAliasListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param DistrictAliasRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DistrictAliasRequest $request, int $id)
    {
        // Retrieve the DistrictAlias from the database
       try {
            $districtAlias = $this->repository->findById($id);
            if ($districtAlias) {
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

     * Update the status of an DistrictAlias record to 'rejected'.
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
     * Update the status of an DistrictAlias record to 'Active'.
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
     * Update the status of an DistrictAlias record to 'Approved'.
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
