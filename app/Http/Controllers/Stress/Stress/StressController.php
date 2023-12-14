<?php

namespace App\Http\Controllers\Stress\Stress;

use Exception;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
use App\Exports\ErrorExport;
use Illuminate\Http\Request;
use App\Models\Stress\Stress;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomImportsService;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Auth\AuthenticationException;
use App\Services\Stress\Stress\StressService;
use App\Http\Requests\Stress\Stress\StressRequest;
use App\Http\Requests\BulkInsert\BulkInsertRequest;
use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class StressController extends Controller
{
    protected $service, $model;

    /**
     * Base URL of this module
     */
    private string $baseUrl = "/stress/stress";

    /**
     * Injects Stress Service dependency through the constructor
     *
     * @param StressService $service
     *
     * @return Void
     */
    public function __construct(StressService $service, Stress $model)
    {
        $this->service = $service;
        $this->model = $model;
    }

    /**
     * List page to display all data with pagination support.
     *
     *@link http://stress/stress
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
        try {
            return Inertia::render(
                component: 'Frontend/List',
                props: [
                    'type' => 'List',
                    'title' => "All Stress",
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
        if ($code !== "SUCCESS") {
            return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
        } else {
            return redirect($this->baseUrl);
        }
    }

    /**
     * Get all data with ID:Name pair in JSON format
     *
     * @param None
     * @return Inertia
     */
    public function list(Request $request)
    {
        return $this->service->getAllRecords();
    }

    /**
     * Get all data with ID:Name pair in JSON format search by Parent ID/ Country ID
     *
     * @param None
     * @return Inertia
     */
    public function listByParent(Request $request, $id)
    {
        return $this->service->getAllRecords("StressTypeID", $id);
    }

    /**
     * Displays a form to add new Stress
     *
     *@link http://stress/stress/create/
     *
     *@method GET
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render(
            component: 'Frontend/Create',
            props: [
                'type' => 'Add',
                'title' => 'Add Stress',
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
     *@link http://stress/stress/store
     *
     *@method POST
     *
     * @param StressRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StressRequest $request)
    {
        $data = null;
        $code = "SUCCESS";
        try {
            $this->service->add(data: $request);
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
            dd($code);
            return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
        } else {
            return redirect($this->baseUrl);
        }
    }

    /**
     * Displays a form with values to update Stress
     *
     *@link http://stress/stress/edit/id
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
            $data = $this->service->findStressById($id);
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
                    'title' => 'Stress',
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
        if ($code !== "SUCCESS") {
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
     *@link http://stress/stress/update/id
     *
     *@method PATCH/PUT
     *
     * @param StressRequest  $request The request object
     * @param int $id The request object
     *
     * @return request
     */
    public function update(StressRequest $request, int $id)
    {
        $data = null;
        $code = "SUCCESS";
        try {
            $this->service->update($request, $id);
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
        if ($code !== "SUCCESS") {
            return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
        } else {
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
        $code = "SUCCESS";
        try {
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
        if ($code !== "SUCCESS") {
            return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
        } else {
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
        $code = "SUCCESS";
        try {
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
        if ($code !== "SUCCESS") {
            return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
        } else {
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
        $code = "SUCCESS";
        try {
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
        if ($code !== "SUCCESS") {
            return ResponseHelper::respond(
                code: $code,
                data: $data,
            );
        } else {
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
    public function import(BulkInsertRequest $bulkInsertRequest)
    {
        $code = "SUCCESS";
        try {
            $validation = [
                'Name' => 'required|unique:agri_stress|distinct',
                'StressTypeID' => 'required'
            ];
            $validationArr = collect($validation)->keys();

             //Remove slash from value
             $validationArr = $validationArr->map(function (String $value) {
                return Str::replace('\\','',$value);
            });

            $file = $bulkInsertRequest->file('name');


            //fetch all headings from excel
            $headings = (new HeadingRowImport)->toCollection($file)->first()->first();
            //campare and validate excel heading
            $diff = $validationArr->diff($headings)->filter()->all();

            if(!empty($diff)){
                return redirect("{$this->baseUrl}/create")
                ->withErrors(['name' => "Invalid header"]);
            }else{
                $import = new CustomImportsService($this->model, $validation);
                $import->import($file);
            }
        } catch (ValidationException $e) {
            $code = "DATA_NOT_FOUND";
            $collection = (new CustomImportsService($this->model, []))->toCollection($file);
            $failures = $e->failures();
            $fileName = $this->model->getTable() . '_error.xlsx';
            Excel::store(new ErrorExport($failures, $collection), $fileName, 'local');
            $path = url("{$this->baseUrl}/download/{$fileName}");
           // return an error
           return redirect("{$this->baseUrl}/create")
           ->withErrors(['importErrorUrl' => $path]);
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
