<?php

namespace App\Services\Agriculture\Band;

use Exception;
use App\Http\Requests\Agriculture\Band\BandRequest;
use App\Repositories\Agriculture\Band\BandRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Agriculture\Band\Lists\BandListResource;
use App\Http\Resources\Agriculture\Band\Lists\BandListCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Resources\Agriculture\Band\Table\BandTableCollection;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;


class BandService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param BandRepository $repository
     *
     * @return void
     */
    public function __construct(BandRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return BandTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
           return new BandTableCollection($this->repository->find($on, $search, $rowsPerPage));
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
     * @return  BandListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  BandListCollection(
                $this->repository->all($on, $search)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new Band in the DB
     *
     * @param BandRequest $data
     *
     * @return Array
     */
    public function add(BandRequest $data )
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
     * Render the edit view for the Band model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findBandById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new BandListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param BandRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BandRequest $request, int $id)
    {
        // Retrieve the Band from the database
       try {
            $band = $this->repository->findById($id);
            if ($band) {
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

     * Update the status of an Band record to 'rejected'.
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
     * Update the status of an Band record to 'Active'.
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
     * Update the status of an Band record to 'Approved'.
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
