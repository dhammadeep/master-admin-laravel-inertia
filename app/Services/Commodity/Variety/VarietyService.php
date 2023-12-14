<?php

namespace App\Services\Commodity\Variety;

use Exception;
use App\Http\Requests\Commodity\Variety\VarietyRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Commodity\Variety\VarietyRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Resources\Commodity\Variety\Lists\VarietyListResource;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Commodity\Variety\Lists\VarietyListCollection;
use App\Http\Resources\Commodity\Variety\Table\VarietyTableCollection;


class VarietyService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param VarietyRepository $repository
     *
     * @return void
     */
    public function __construct(VarietyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  VarietyListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  VarietyListCollection(
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
     * @return VarietyCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');
        try {
            // Return in the given API resource format
            return new VarietyTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new  Variety in the DB
     *
     * @param VarietyRequest $data
     *
     * @return Array
     */
    public function add(VarietyRequest $data)
    {
        try {
            $varietyData = collect($data->Name)->combine($data->VarietyCode);
            $finalData = collect();
            collect($varietyData)->map(function ($item, $key) use($data,$finalData) {
                $data = collect($data->request)->map(function ($dataItem, $dataKey) use($item, $key){
                    if($dataKey == 'Name'){
                        $dataItem = $key;
                    }
                    if($dataKey == 'VarietyCode'){
                        $dataItem = $item;
                    }
                    return $dataItem;
                });
                $finalData->push($data);
            });
            $data->request =$finalData;
            return $this->repository->add($data);
        } catch (BadRequestException $e) {
            throw $e;
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            dd($e);
            throw $e;
        }
    }

    /**
     * Render the edit view for the Variety model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findVarietyById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new VarietyListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param VarietyRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VarietyRequest $request, int $id)
    {
        // Retrieve the  Variety from the database
        try {
            $variety = $this->repository->findById($id);
            if ($variety) {
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

     * Update the status of an  Variety record to 'rejected'.
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
     * Update the status of an  Variety record to 'Active'.
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
     * Update the status of an  Variety record to 'Approved'.
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
