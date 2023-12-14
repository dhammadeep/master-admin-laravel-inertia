<?php

namespace App\Http\Controllers\Regional\MonthlyTravelTime;

use Exception;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\Regional\MonthlyTravelTime\MonthlyTravelTimeService;
use App\Http\Requests\Regional\MonthlyTravelTime\MonthlyTravelTimeRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class MonthlyTravelTimeController extends Controller
{
    protected $service;

    /**
     * Base URL of this module
    */
    private string $baseUrl = "/regional/monthly-travel-time";

    /**
     * Injects MonthlyTravelTime Service dependency through the constructor
     *
     * @param MonthlyTravelTimeService $service
     *
     * @return Void
     */
    public function __construct(MonthlyTravelTimeService $service)
    {
        $this->service = $service;
    }

    /**
     * List page to display all data with pagination support.
     *
     *@link http://regional/monthly-travel-time
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
                'title' => "All Regional Monthly Travel Time",
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
     * Displays a form to add new MonthlyTravelTime
     *
     *@link http://regional/monthly-travel-time/create/
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
                'title' => 'Add Regional Monthly Travel Time',
                'url' => $this->baseUrl,
                'fields' => $this->service->getFormFields()
            ]
        );
    }

     /**
     * Store a newly created resource in storage.
     *
     *@link http://regional/monthly-travel-time/store
     *
     *@method POST
     *
     * @param MonthlyTravelTimeRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MonthlyTravelTimeRequest $request)
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
     * Displays a form with values to update MonthlyTravelTime
     *
     *@link http://regional/monthly-travel-time/edit/id
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
            $data = $this->service->findMonthlyTravelTimeById($id);
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
                    'title' => 'Regional Monthly Travel Time',
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
     *@link http://regional/monthly-travel-time/update/id
     *
     *@method PATCH/PUT
     *
     * @param MonthlyTravelTimeRequest  $request The request object
     * @param int $id The request object
     *
     * @return request
     */
    public function update(MonthlyTravelTimeRequest $request, int $id)
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
}
