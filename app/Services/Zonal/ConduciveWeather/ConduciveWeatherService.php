<?php

namespace App\Services\Zonal\ConduciveWeather;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Requests\Zonal\ConduciveWeather\ConduciveWeatherRequest;
use App\Repositories\Zonal\ConduciveWeather\ConduciveWeatherRepository;
use App\Http\Resources\Zonal\ConduciveWeather\Lists\ConduciveWeatherListResource;
use App\Http\Resources\Zonal\ConduciveWeather\Lists\ConduciveWeatherListCollection;
use App\Http\Resources\Zonal\ConduciveWeather\Table\ConduciveWeatherTableCollection;


class ConduciveWeatherService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param ConduciveWeatherRepository $repository
     *
     * @return void
     */
    public function __construct(ConduciveWeatherRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  ConduciveWeatherListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  ConduciveWeatherListCollection(
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
     * @return ConduciveWeatherTableCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        try {
           return new ConduciveWeatherTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new ConduciveWeather in the DB
     *
     * @param ConduciveWeatherRequest $data
     *
     * @return Array
     */
    public function add(ConduciveWeatherRequest $data )
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
     * Render the edit view for the ConduciveWeather model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findConduciveWeatherById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new ConduciveWeatherListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param ConduciveWeatherRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ConduciveWeatherRequest $request, int $id)
    {
        // Retrieve the ConduciveWeather from the database
       try {
            $conduciveWeather = $this->repository->findById($id);
            if ($conduciveWeather) {
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

     * Update the status of an ConduciveWeather record to 'rejected'.
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
     * Update the status of an ConduciveWeather record to 'Active'.
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
     * Update the status of an ConduciveWeather record to 'Approved'.
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
