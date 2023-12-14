<?php

namespace App\Http\Controllers\Agriculture\AlliedActivity;

use Exception;
use Inertia\Inertia;
use Inertia\Response;
use App\Exports\ErrorExport;
use Illuminate\Http\Request;
use App\Exports\CustomExport;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomImportsService;
use Illuminate\Database\QueryException;
use App\Models\Agriculture\AlliedActivity;
use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\BulkInsert\BulkInsertRequest;
use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\Agriculture\AlliedActivity\AlliedActivityService;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Requests\Agriculture\AlliedActivity\AlliedActivityRequest;

class AlliedActivityController extends Controller
{
    protected $service, $model;

    /**
     * Base URL of this module
     */
    private string $baseUrl = "/agriculture/allied-activity";

    /**
     * Injects AlliedActivity Service dependency through the constructor
     *
     * @param AlliedActivityService $service
     *
     * @return Void
     */
    public function __construct(AlliedActivityService $service, AlliedActivity $model)
    {
        $this->service = $service;
        $this->model = $model;
    }

    /**
     * List page to display all data with pagination support.
     *
     *@link http://agriculture/allied-activity
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
                    'title' => "All Allied Activity",
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
     * Displays a form to add new AlliedActivity
     *
     *@link http://agriculture/allied-activity/create/
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
                'title' => 'Add Allied Activity',
                'downloadUrl' => config('app.s3_url') . "{$this->model->getTable()}.xlsx",
                'importUrl' => 'import',
                'url' => $this->baseUrl,
                'fields' => $this->service->getFormFields()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     *@link http://agriculture/allied-activity/store
     *
     *@method POST
     *
     * @param AlliedActivityRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AlliedActivityRequest $request)
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
        $code = "DATA_NOT_FOUND";


        $data = [
            'type' => 'Add',
            'title' => 'Add Allied Activity',
            'downloadUrl' => config('app.s3_url') . "{$this->model->getTable()}.xlsx",
            'importUrl' => 'import',
            'url' => $this->baseUrl,
            'fields' => $this->service->getFormFields()
        ];

        $data['errors']['errorModalHeader']= 'Error';
        $data['errors']['errorModalBody']= 'This data not found';
        if ($code !== "SUCCESS") {
            return ResponseHelper::respond(
                code: $code,
                data: $data,
            );


            // $data['errors']['errorModalHeader']= 'Error';
            // $data['errors']['errorModalBody']= 'This data not found';
            // return redirect($this->baseUrl.'/create');
            // return redirect (Inertia::render(
            //     component: 'Frontend/Create',
            //     props:  $data
            // ));

            // return $this->baseUrl.'/create';
            //return redirect()->route($this->baseUrl.'/create')->with('Frontend/Create', $data);

            // return Inertia::render(
            //         component: 'Frontend/Create',
            //         props:  $data
            //     );
            // return Inertia::render(
            //     component: 'Frontend/Create',
            //     props:  $data
            // );

            // return redirect($this->baseUrl.'/create');



        } else {

            ResponseHelper::respond(
                code: $code,
                data: $data,
            );

            // return redirect($this->baseUrl);
        }
    }

    /**
     * Displays a form with values to update AlliedActivity
     *
     *@link http://agriculture/allied-activity/edit/id
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
            $data = $this->service->findAlliedActivityById($id);
            $fieldsCollection = collect($this->service->getFormFields())->map(function ($fields) use ($data) {
                $attrib = $fields['name'];
                $fields['value']  = $data[$attrib];
                return $fields;
            });
            return Inertia::render(
                component: 'Frontend/Create',
                props: [
                    'type' => 'Edit',
                    'title' => 'Allied Activity',
                    'methodName' => 'PUT',
                    'importUrl' => 'import',
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
     *@link http://agriculture/allied-activity/update/id
     *
     *@method PATCH/PUT
     *
     * @param AlliedActivityRequest  $request The request object
     * @param int $id The request object
     *
     * @return request
     */
    public function update(AlliedActivityRequest $request, int $id)
    {
        $data = null;
        $code = "SUCCESS";
        try {
            $this->service->update(
                request: $request,
                id: $id
            );
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
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
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
                'Name' => 'required',
            ];
            $file = $bulkInsertRequest->file('name');
            $import = new CustomImportsService($this->model, $validation);
            $import->import($file);
        } catch (ValidationException $e) {
            $code = "DATA_NOT_FOUND";
            $collection = (new CustomImportsService($this->model, []))->toCollection($file);
            $failures = $e->failures();
            $fileName = $this->model->getTable() . '_error.xlsx';
            Excel::store(
                new ErrorExport($failures, $collection),
                $fileName,
                'local'
            );
            //TODO: Remove redirect and send response
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

    public function download($fileName)
    {
        $filePath = storage_path('app/' . $fileName);
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
