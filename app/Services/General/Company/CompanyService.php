<?php

namespace App\Services\General\Company;

use Exception;
use App\Http\Requests\General\Company\CompanyRequest;
use App\Repositories\General\Company\CompanyRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\General\Company\Lists\CompanyListResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Resources\General\Company\Lists\CompanyListCollection;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\General\Company\Table\CompanyTableCollection;


class CompanyService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param CompanyRepository $repository
     *
     * @return void
     */
    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return CompanyTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
            return new CompanyTableCollection($this->repository->find($on, $search, $rowsPerPage));
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
     * @return  CompanyListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  CompanyListCollection(
                $this->repository->all($on, $search)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new Company in the DB
     *
     * @param CompanyRequest $data
     *
     * @return Array
     */
    public function add(CompanyRequest $data )
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
     * Render the edit view for the Company model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findCompanyById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new CompanyListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param CompanyRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CompanyRequest $request, int $id)
    {
        // Retrieve the Company from the database
       try {
            $company = $this->repository->findById($id);
            if ($company) {
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

     * Update the status of an Company record to 'rejected'.
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
     * Update the status of an Company record to 'Active'.
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
     * Update the status of an Company record to 'Approved'.
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
