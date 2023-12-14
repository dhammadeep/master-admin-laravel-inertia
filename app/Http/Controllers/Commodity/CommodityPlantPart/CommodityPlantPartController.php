<?php

namespace App\Http\Controllers\Commodity\CommodityPlantPart;

use Exception;
use Inertia\Inertia;
use Inertia\Response;
use App\Exports\ErrorExport;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomImportsService;
use Illuminate\Database\QueryException;
use App\Models\Commodity\CommodityPlantPart;
use Illuminate\Auth\AuthenticationException;
use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ImportRequest\ImportValidationRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Services\Commodity\CommodityPlantPart\CommodityPlantPartService;
use App\Http\Requests\Commodity\CommodityPlantPart\CommodityPlantPartRequest;

class CommodityPlantPartController extends Controller
{
    protected $service, $model;

    /**
     * Base URL of this module
    */
    private string $baseUrl = "/commodity/commodity-plant-part";

    /**
     * Injects CommodityPlantPart Service dependency through the constructor
     *
     * @param CommodityPlantPartService $service
     *
     * @return Void
     */
    public function __construct(CommodityPlantPartService $service, CommodityPlantPart $model)
    {
        $this->service = $service;
        $this->model = $model;
    }

    /**
     * List page to display all data with pagination support.
     *
     *@link http://commodity/commodity-plant-part
     *
     *@method GET
     *
     * @param Request $request The request object
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $data = null;
        $code = "SUCCESS";
        try{
        return Inertia::render(
            component: 'Frontend/List',
            props: [
                'type' => 'List',
                'title' => "All Commodity Plant Part",
                'data' => $this->service->getAllPaginatedTableData(
                    on: $request->on,
                    search: $request->search
                ),
                'filters' => $request->only(['on', 'search']),
                'url' => $this->baseUrl,
                'actions' => [
                    'Edit',
                    'Approve',
                    'Finalize',
                    'Reject'
                ]
            ]
        );
            } catch (AuthenticationException $e) {
                $code = "HTTP_AUTHENTICATION_ERROR";
            } catch (NotFoundHttpException $e) {
                $code = "HTTP_REQUEST_FAILURE";
            } catch (BadRequestException $e) {   //if validation fails
                $code = "DATA_NOT_FOUND";
            } catch (QueryException $e) {
                $code = "QUERY_EXCEPTION";
            } catch (Exception $e) {
                $code = "DATA_NOT_FOUND";
            }
            if($code!=="SUCCESS"){
                return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
            } else {
                return redirect($this->baseUrl);
            }
    }

    /**
     * Displays a form to add new CommodityPlantPart
     *
     *@link http://commodity/commodity-plant-part/create/
     *
     *@method GET
     *
     * @return Response
     */
    public function create():Response
    {
        return Inertia::render(
            component: 'Frontend/Create',
            props: [
                'type' => 'Add',
                'title' => 'Add Commodity Plant Part',
                'url' => $this->baseUrl,
                'downloadUrl' => config('app.s3_url') . "{$this->model->getTable()}.xlsx",
                'importUrl' => 'import',
                'fields' => $this->service->getFormFields()
            ]
        );
    }

     /**
     * Store a newly created resource in storage.
     *
     *@link http://commodity/commodity-plant-part/store
     *
     *@method POST
     *
     * @param CommodityPlantPartRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommodityPlantPartRequest $request)
    {
        $data = null;
        $code = "SUCCESS";
        try {
            $fileUrl = $this->service->S3ImageUpload($request);
            $this->service->add($fileUrl,data: $request);
        } catch (AuthenticationException $e) {
            $code = "HTTP_AUTHENTICATION_ERROR";
        } catch (NotFoundHttpException $e) {
            $code = "HTTP_REQUEST_FAILURE";
        } catch (BadRequestException $e) {   //if validation fails
            $code = "DATA_NOT_FOUND";
        } catch (QueryException $e) {
            $code = "QUERY_EXCEPTION";
        } catch (Exception $e) {
            $code = "DATA_NOT_FOUND";
        }
        if($code!=="SUCCESS"){
                return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
        } else {
            return redirect($this->baseUrl);
        }
    }

     /**
     * Displays a form with values to update CommodityPlantPart
     *
     *@link http://commodity/commodity-plant-part/edit/id
     *
     *@method GET
     *
     * @return Response
     */
    public function edit(int $id): Response
    {
        $data = null;
        $code = "SUCCESS";
        try {
            $data = $this->service->findCommodityPlantPartById($id);
            $fieldsCollection = collect($this->service->getFormFields())->map(function ($fields) use ($data) {
                $attrib = $fields['name'];
                $fields['value']  = $data[$attrib];
                return $fields;
            });

            return Inertia::render(
                component: 'Frontend/Create',
                props: [
                    'type' => 'Edit',
                    'methodName' => 'PUT',
                    'title' => 'Commodity Plant Part',
                    'url' => "{$this->baseUrl}/$id",
                    'fields' => $fieldsCollection
                ]
            );
            } catch (AuthenticationException $e) {
            $code = "HTTP_AUTHENTICATION_ERROR";
        } catch (NotFoundHttpException $e) {
            $code = "HTTP_REQUEST_FAILURE";
        } catch (BadRequestException $e) {   //if validation fails
            $code = "DATA_NOT_FOUND";
        } catch (QueryException $e) {
            $code = "QUERY_EXCEPTION";
        } catch (Exception $e) {
            $code = "DATA_NOT_FOUND";
        }
        if($code!=="SUCCESS"){
            dd($e);
            return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
        } else {
            return redirect($this->baseUrl);
        }
    }

    /**
     * update the status in list
     *
     *@link http://commodity/commodity-plant-part/update/id
     *
     *@method PATCH/PUT
     *
     * @param CommodityPlantPartRequest  $request The request object
     * @param int $id The request object
     *
     * @return request
     */
    public function update(CommodityPlantPartRequest $request, int $id)
    {
        $data = null;
        $code = "SUCCESS";
        try {
            if ($request->hasFile('FileUrl')) {
                $fileUrl = $this->service->S3ImageUpload($request);
                if ($fileUrl) {
                    //Remove old image
                    $this->service->S3ImageDelete($id);
                }
            }
            $this->service->update($request, $fileUrl, $id);
        } catch (AuthenticationException $e) {
            $code = "HTTP_AUTHENTICATION_ERROR";
        } catch (NotFoundHttpException $e) {
            $code = "HTTP_REQUEST_FAILURE";
        } catch (ModelNotFoundException $e) {
            $code = "HTTP_REQUEST_FAILURE";
        } catch (BadRequestException $e) {   //if validation fails
            $code = "DATA_NOT_FOUND";
        } catch (QueryException $e) {
            $code = "QUERY_EXCEPTION";
        } catch (Exception $e) {
            $code = "DATA_NOT_FOUND";
        }
        if($code!=="SUCCESS"){
            dd($e);
            return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
        }else{
            return redirect($this->baseUrl);
        }
    }

    /**
     * reject the status in list
     *
     * @param Request $request The request object
     *
     * @return request
     */
     public function reject(Request $request)
    {
        $data = null;
        $code ="SUCCESS";
        try{
        $id = $request->all();
        $this->service->updateRejectStatus(
            id: $id
        );
        } catch (AuthenticationException $e) {
            $code = "HTTP_AUTHENTICATION_ERROR";
        } catch (NotFoundHttpException $e) {
            $code = "HTTP_REQUEST_FAILURE";
        } catch (BadRequestException $e) {   //if validation fails
            $code = "DATA_NOT_FOUND";
        } catch (QueryException $e) {
            $code = "QUERY_EXCEPTION";
        } catch (Exception $e) {
            $code = "DATA_NOT_FOUND";
        }
        if($code!=="SUCCESS"){
            return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
        }else{
            return redirect($this->baseUrl);
        }
    }

    /**
     * finalize the status in list
     *
     * @param Request $request The request object
     *
     * @return request
     */
    public function finalize(Request $request)
    {
        $data = null;
        $code ="SUCCESS";
        try{
        $id = $request->all();
        $this->service->updateFinalizeStatus(
            id: $id
        );
        } catch (AuthenticationException $e) {
            $code = "HTTP_AUTHENTICATION_ERROR";
        } catch (NotFoundHttpException $e) {
            $code = "HTTP_REQUEST_FAILURE";
        } catch (BadRequestException $e) {   //if validation fails
            $code = "DATA_NOT_FOUND";
        } catch (QueryException $e) {
            $code = "QUERY_EXCEPTION";
        } catch (Exception $e) {
            $code = "DATA_NOT_FOUND";
        }
       if($code!=="SUCCESS"){
            return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
        }else{
            return redirect($this->baseUrl);
        }
    }

    /**
     * approve the status in list
     *
     * @param Request $request The request object
     *
     * @return request
     */
    public function approve(Request $request)
    {
        $data = null;
        $code ="SUCCESS";
        try{
        $id = $request->all();
        $this->service->updateApproveStatus(
            id: $id
        );
        } catch (AuthenticationException $e) {
            $code = "HTTP_AUTHENTICATION_ERROR";
        } catch (NotFoundHttpException $e) {
            $code = "HTTP_REQUEST_FAILURE";
        } catch (BadRequestException $e) {   //if validation fails
            $code = "DATA_NOT_FOUND";
        } catch (QueryException $e) {
            $code = "QUERY_EXCEPTION";
        } catch (Exception $e) {
            $code = "DATA_NOT_FOUND";
        }
        if($code!=="SUCCESS"){
            return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
        }else{
            return redirect($this->baseUrl);
        }
    }

    /* import the specified resource in db.
    *
    * @param \App\Http\Requests\Test\Request $request
    * @param int $request
    *
    * @return \Illuminate\Http\RedirectResponse
    */
    public function import(ImportValidationRequest $importValidationRequest)
    {
        $code = "SUCCESS";
        try {
            $validation = [
                'Name' => 'required|unique:agri_commodity'
            ];
            $file = $importValidationRequest->file('name');

            $filenameWithExtension = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            if ($filename == $this->model->getTable()) {
                $import = new CustomImportsService($this->model, $validation);
                $import->import($file);
            } else {
                $code = "DATA_NOT_FOUND";
            }
        } catch (ValidationException $e) {
            $code = "DATA_NOT_FOUND";
            $collection = (new CustomImportsService($this->model, []))->toCollection($file);
            $failures = $e->failures();
            $fileName = $this->model->getTable().'_error.xlsx';
            Excel::store(new ErrorExport($failures, $collection), $fileName, 'local');
            $path = url("{$this->baseUrl}/download/{$fileName}");
            return redirect("{$this->baseUrl}/create")
                ->withErrors(['url' => $path]);
        } catch (AuthenticationException $e) {
            $code = "HTTP_AUTHENTICATION_ERROR";
        } catch (NotFoundHttpException $e) {
            $code = "HTTP_REQUEST_FAILURE";
        } catch (BadRequestException $e) {   //if validation fails
            $code = "DATA_NOT_FOUND";
        } catch (QueryException $e) {
            $code = "QUERY_EXCEPTION";
        } catch (Exception $e) {
            $code = "DATA_NOT_FOUND";
        }
        if ($code !== "SUCCESS") {
            return ResponseHelper::respond(
                code: $code,
            );
        } else {
            return redirect($this->baseUrl);
        }
    }

    public function download($file_name)
    {
        $file_path = storage_path('app/' . $file_name);
        return response()->download($file_path)->deleteFileAfterSend(true);
    }
}
