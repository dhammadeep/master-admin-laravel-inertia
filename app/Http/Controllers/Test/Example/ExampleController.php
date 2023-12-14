<?php

namespace App\Http\Controllers\Test\Example;

use Error;
use Exception;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
use App\Exports\ErrorExport;
use App\Models\Test\Example;
use Illuminate\Http\Request;
use App\Exports\CustomExport;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomImportsService;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\HeadingRowImport;
use App\Http\Requests\Test\ExampleRequest;
use Illuminate\Auth\AuthenticationException;
use App\Services\Test\Example\ExampleService;
use App\Http\Requests\BulkInsert\BulkInsertRequest;
use Maatwebsite\Excel\Validators\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ExampleController extends Controller
{
    protected $service, $model;

    /**
     * Base URL of this module
     */
    private string $baseUrl = "/test/example";

    /**
     * Injects Example Service dependency through the constructor
     *
     * @param ExampleService $service
     *
     * @return Void
     */
    public function __construct(ExampleService $service, Example $model)
    {
        $this->service = $service;
        $this->model = $model;
    }

    /**
     * List page to display all data with pagination support.
     *
     * @param Request $request The request object
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render(
            component: 'Test/Example/ListExample',
            props: [
                'type' => 'List',
                'title' => 'Examples',
                'data' => $this->service->getAllPaginatedTableData(
                    on: $request->on,
                    search: $request->search
                ),
                'filters' => $request->only(['on', 'search']),

                'url' => $this->baseUrl,
                // TODO: Control list of actions using ACL
                'actions' => [
                    'Edit',
                    'Approve',
                    'Finalize',
                    'Reject'
                ]
            ]
        );
    }

    /**
     * Displays a form to add new Example
     *
     * @param Request $request The request object
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render(
            component: 'Test/Example/CreateExample',
            props: [
                'type' => 'Add',
                'title' => 'Add Example',
                'url' => $this->baseUrl,
                'downloadUrl' => config('app.s3_url') . "{$this->model->getTable()}.xlsx",
                'importUrl' => 'import',
                'fields' => $this->service->getFormFields(),
                'importErrorUrl'=>''
            ]
        );
    }

    /**
     * Render the edit view for the Example model.
     *
     * @link http://test/example/1082/edit
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id): Response
    {
        $data = null;
        $code = "SUCCESS";
        try {
            $data = $this->service->findExampleById($id);
            $fieldsCollection = collect($this->service->getFormFields())->map(function ($fields) use ($data) {
                $attrib = $fields['name'];
                $fields['value']  = $data[$attrib];
                return $fields;
            });

            return Inertia::render(
                component: 'Test/Example/CreateExample',
                props: [
                    'type' => 'Edit',
                    'methodName' => 'PUT',
                    'title' => 'Edit Example',
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
        if ($code != "SUCCESS") {
            return ResponseHelper::respond(
                code: $code
            );
        }
        return redirect($this->baseUrl);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Test\ExampleRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ExampleRequest $request)
    {
        $code = "SUCCESS";
        try {
            $fileUrl = $this->service->S3ImageUpload($request);
            $this->service->add($fileUrl, data: $request);
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
        if ($code != "SUCCESS") {
            return ResponseHelper::respond(
                code: $code
            );
        } else {
            return redirect($this->baseUrl);
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param \App\Http\Requests\Test\ExampleRequest $request
     * @param int $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ExampleRequest $request, int $id)
    {
        $code = "SUCCESS";
        $fileUrl = '';
        try {
            if ($request->hasFile('ProfilePhoto')) {
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
        } catch (BadRequestException $e) {   //if validation fails
            $code = "DATA_NOT_FOUND";
        } catch (QueryException $e) {
            $code = "QUERY_EXCEPTION";
        } catch (Exception $e) {
            $code = "DATA_NOT_FOUND";
        }
        if ($code != "SUCCESS") {
            dd($e);
            ResponseHelper::respond(
                code: $code
            );
        }
        return redirect($this->baseUrl);
    }



    /**
     * reject the specified resource in db.
     *
     * @param \App\Http\Requests\Test\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
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
            );
        } else {
            return redirect($this->baseUrl);
        }
    }

    /**
     * TODO: Create proper PHP Docblock
     * TODO: Need to touch Model via Service -> Repository
     * TODO: Also add interface entry for these methods
     * TODO: Add custom Request object to validate input and authentication
     */
    /**
     * finalize the specified resource in db.
     *
     * @param \App\Http\Requests\Test\Request $request
     * @param int $request
     *
     * @return \Illuminate\Http\RedirectResponse
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
            );
        } else {
            return redirect($this->baseUrl);
        }
    }

    /**
     * TODO: Create proper PHP Docblock
     * TODO: Need to touch Model via Service -> Repository
     * TODO: Also add interface entry for these methods
     * TODO: Add custom Request object to validate input and authentication
     */
    /**
     * finalize the specified resource in db.
     *
     * @param \App\Http\Requests\Test\Request $request
     * @param int $request
     *
     * @return \Illuminate\Http\RedirectResponse
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
            );
        } else {
            return redirect($this->baseUrl);
        }
    }

    /**
     * finalize the specified resource in db.
     *
     * @param
     * @param int $tableName
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tableFieldsGenerator($tableName = null)
    {
        $columns = [];

        if ($tableName) {
            $db = env('DB_DATABASE');
            $query = "SELECT COLUMN_NAME, DATA_TYPE
                    FROM information_schema.columns
                    WHERE table_schema = '$db'
                    AND table_name = '$tableName'";
            $columns = DB::select($query);
        }

        return Inertia::render(
            component: 'Test/Example/TableFieldGenerator',
            props: [
                'columns' => $columns
            ]
        );
    }

    /* finalize the specified resource in db.
    *
    * @param \App\Http\Requests\Test\Request $request
    * @param int $request
    *
    * @return \Illuminate\Http\RedirectResponse
    */
    public function tableNames()
    {
        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current', $tables);

        return $tables;
    }

    /* finalize the specified resource in db.
    *
    * @param \App\Http\Requests\Test\Request $request
    * @param int $request
    *
    * @return \Illuminate\Http\RedirectResponse
    */
    public function generateTableFields(Request $request)
    {
        $columns = [];
        $data = $request->all();

        foreach ($data as $d) {
            // var_export($d);
            $position = $d['position'];
            $columns[$position] = [];
            if (!empty($d['name'])) {
                $columns[$position]['name'] = $d['name'];
            }
            if (!empty($d['label'])) {
                $columns[$position]['label'] = $d['label'];
            }
            if (!empty($d['type'])) {
                $columns[$position]['type'] = $d['type'];
            }
            if (!empty($d['tableComponent'])) {
                $columns[$position]['tableComponent'] = $d['tableComponent'];
            }
            if (!empty($d['formComponent'])) {
                $columns[$position]['formComponent'] = $d['formComponent'];
            }
            if (!empty($d['searchable'])) {
                $columns[$position]['searchable'] = $d['searchable'];
            }
            if (!empty($d['source'])) {
                $columns[$position]['source'] = $d['source'];
            }
            if (!empty($d['mount'])) {
                $columns[$position]['mount'] = $d['mount'] == 'Yes' ? true : false;
            }
            if (!empty($d['validations'])) {
                // var_export($d['validations']);
                if (isset($d['validations']['required'])) {
                    $columns[$position]['validations']['required'] = true;
                }
                if (isset($d['validations']['email'])) {
                    $columns[$position]['validations']['email'] = true;
                }
            }
            if (count($d['options'])) {
                foreach ($d['options'] as $option) {
                    if (!empty($option['label']) && !empty($option['value'])) {
                        $columns[$position]['options'][] = array(
                            'label' => $option['label'],
                            'value' => $option['value']
                        );
                    }
                    if (!empty($option['label']) && !empty($option['color'])) {
                        $key = $option['label'];
                        $columns[$position]['colors'][$key] = $option['color'];
                    }
                }
            }

            //----------------Extra fields----------------//
            if (!empty($d['extraname'])) {
                $columns[$position]['extraname'] = $d['extraname'];
            }
            if (!empty($d['extralabel'])) {
                $columns[$position]['extralabel'] = $d['extralabel'];
            }
            if (!empty($d['extraType'])) {
                $columns[$position]['extraType'] = $d['extraType'];
            }
            if (!empty($d['extraTableComponent'])) {
                $columns[$position]['extraTableComponent'] = $d['extraTableComponent'];
            }
            if (!empty($d['extraSearchable'])) {
                $columns[$position]['extraSearchable'] = $d['extraSearchable'];
            }
            //----------------Extra fields----------------//

            // var_export($columns[$position]);
            // break;
        }

        ksort($columns);
        echo '<?php' . "\n\n";
        echo 'protected static $tableFields = ';
        var_export($columns);
        echo ';';
    }

    /* finalize the specified resource in db.
    *
    * @param \App\Http\Requests\Test\Request $request
    * @param int $request
    *
    * @return \Illuminate\Http\RedirectResponse
    */
    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        $code = "SUCCESS";
        try {
            //isSample - when download sample data it must be true
            return Excel::download(new CustomExport($isSample = true, Example::class), 'examples.xlsx');
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
        return ResponseHelper::respond(
            code: $code,
        );
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
            //Define fields to validate excel data
            $validation = [
                'Name' => 'required',
                'Gender' => 'required',
                'AboutMe' => 'required',
                'CountryID\.Country\.Name' => 'required|exists:geo_country,Name',
                'StateID\.State\.Name' => 'required|exists:geo_state,Name',
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
            $collection = (new CustomImportsService($this->model))->toCollection($file);
            $failures = $e->failures();
            $fileName = $this->model->getTable() . '_error.xlsx';
            Excel::store(
                new ErrorExport($failures, $collection),
                $fileName,
                'local'
            );
            //TODO: Remove redirect and send response
            $path = url("{$this->baseUrl}/download/{$fileName}");
            // return an error
            return redirect("{$this->baseUrl}/create")
                ->withErrors(['importErrorUrl' => $path]);


            //BO: Anjali


            return Inertia::render(
                component: 'Test/Example/CreateExample',
                props: [
                    'type' => 'Add',
                    'title' => 'Add Example',
                    'url' => "{$this->baseUrl}/create",
                    'downloadUrl' => config('app.s3_url') . "{$this->model->getTable()}.xlsx",
                    'importUrl' => 'import',
                    'fields' => $this->service->getFormFields(),
                    'importErrorUrl'=>$path
                ]
            );


            // return redirect("{$this->baseUrl}/create")->withErrors(['importErrorUrl' => $path]);


          // ->setStatusCode(204);
            // return back()->with($this->baseUrl,[
            //     'importErrorUrl' => $path,
            // ]);

            //EO: Anjali


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

    // public function dataExport()
    // {
    //     $code = "SUCCESS";
    //     try {
    //         //$isSample - when download data it must be false
    //         return Excel::download(new CustomExport(false, Example::class), 'examples.xlsx');
    //     } catch (AuthenticationException $e) {
    //         $code = "HTTP_AUTHENTICATION_ERROR";
    //     } catch (NotFoundHttpException $e) {
    //         $code = "HTTP_REQUEST_FAILURE";
    //     } catch (BadRequestException $e) {   //if validation fails
    //         $code = "DATA_NOT_FOUND";
    //     } catch (QueryException $e) {
    //         $code = "QUERY_EXCEPTION";
    //     } catch (Exception $e) {
    //         $code = "DATA_NOT_FOUND";
    //     }
    // }

    public function download($fileName)
    {
        $filePath = storage_path('app/' . $fileName);
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
