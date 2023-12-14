<?php

namespace App\Services\Geographical\VillageAlias;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Requests\Geographical\VillageAlias\VillageAliasRequest;
use App\Repositories\Geographical\VillageAlias\VillageAliasRepository;
use App\Http\Resources\Geographical\VillageAlias\Lists\VillageAliasListResource;
use App\Http\Resources\Geographical\VillageAlias\Lists\VillageAliasListCollection;
use App\Http\Resources\Geographical\VillageAlias\Table\VillageAliasTableCollection;


class VillageAliasService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param VillageAliasRepository $repository
     *
     * @return void
     */
    public function __construct(VillageAliasRepository $repository)
    {
        $this->repository = $repository;
    }

      /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  VillageAliasListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  VillageAliasListCollection(
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
     * @return VillageAliasTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new VillageAliasTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Creates a new VillageAlias in the DB
     *
     * @param VillageAliasRequest $data
     *
     * @return Array
     */
    public function add(VillageAliasRequest $data )
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
     * Render the edit view for the VillageAlias model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findVillageAliasById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new VillageAliasListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param VillageAliasRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VillageAliasRequest $request, int $id)
    {
        // Retrieve the VillageAlias from the database
       try {
            $villageAlias = $this->repository->findById($id);
            if ($villageAlias) {
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

     * Update the status of an VillageAlias record to 'rejected'.
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
     * Update the status of an VillageAlias record to 'Active'.
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
     * Update the status of an VillageAlias record to 'Approved'.
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
