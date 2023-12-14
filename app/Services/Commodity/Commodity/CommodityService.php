<?php

namespace App\Services\Commodity\Commodity;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Commodity\Commodity\CommodityRequest;
use App\Repositories\Commodity\Commodity\CommodityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Resources\Commodity\Commodity\Lists\CommodityListResource;
use App\Http\Resources\Commodity\Commodity\Lists\CommodityListCollection;
use App\Http\Resources\Commodity\Commodity\Table\CommodityTableCollection;


class CommodityService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param CommodityRepository $repository
     *
     * @return void
     */
    public function __construct(CommodityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  CommodityListCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        try {
            return new  CommodityListCollection(
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
     * @return CommodityCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');
        try {
            // Return in the given API resource format
            return new CommodityTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new Commodity in the DB
     *
     * @param CommodityRequest $data
     *
     * @return Array
     */
    public function add(string $fileUrl, CommodityRequest $data)
    {
        try {
            if ($fileUrl) {
                //set image field
                $data->merge([
                    'Logo' => $fileUrl,
                ]);
            }
            return $this->repository->add($fileUrl, $data);
        } catch (BadRequestException $e) {
            throw $e;
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function S3ImageUpload(Request $request)
    {
        try {
            $path = $request->file('Logo')->store('images', 's3');
            $filePath_normal = 'photo/' . $request->file('Logo')->hashName();
            $filePath_thumb = 'thumbnails/' . $request->file('Logo')->hashName();
            $image_normal = Image::make($request->file('Logo'))->widen(800, function ($constraint) {
                $constraint->upsize();
            });
            $image_thumb = Image::make($request->file('Logo'))->crop(100, 100);
            Storage::disk('s3')->put($filePath_normal, $image_normal->stream());
            Storage::disk('s3')->put($filePath_thumb, $image_thumb->stream());
            return Storage::disk('s3')->url($path);
        } catch (BadRequestException $e) {
            throw $e;
        } catch (NotFoundHttpException $e) {
            throw $e;
        }
    }
    public function S3ImageDelete(int $id)
    {
        try {
            $Commodity = $this->repository->findById($id);
            $imgUrl = parse_url($Commodity->Logo);
            Storage::disk('s3')->delete($imgUrl['path']);
            $photo = parse_url(Str::replace('images/', 'photo/', $Commodity->Logo));
            Storage::disk('s3')->delete($photo['path']);
            $thumbnails = parse_url(Str::replace('images/', 'thumbnails/', $Commodity->Logo));
            Storage::disk('s3')->delete($thumbnails['path']);
            return true;
            // return $request->file('Logo')->delete('images', 's3');
        } catch (BadRequestException $e) {
            throw $e;
        } catch (NotFoundHttpException $e) {
            throw $e;
        }
    }

    /**
     * Render the edit view for the Commodity model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findCommodityById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new CommodityListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param CommodityRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommodityRequest $request, $fileUrl, int $id)
    {
        // Retrieve the Commodity from the database
        try {
            $Commodity = $this->repository->findById($id);
            if ($fileUrl) {
                $request->merge([
                    'Logo' => $fileUrl,
                ]);
                $path = $request->file('Logo')->store('images', 's3');
                $filePath_normal = 'photo/' . $request->file('Logo')->hashName();
                $filePath_thumb = 'thumbnails/' . $request->file('Logo')->hashName();
                $image_normal = Image::make($request->file('Logo'))->widen(800, function ($constraint) {
                    $constraint->upsize();
                });
                $image_thumb = Image::make($request->file('Logo'))->crop(100, 100);
                Storage::disk('s3')->put($filePath_normal, $image_normal->stream());
                Storage::disk('s3')->put($filePath_thumb, $image_thumb->stream());
                Storage::disk('s3')->url($path);
            }
            if ($Commodity) {
                return $this->repository->update($request, $id, $fileUrl);
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

     * Update the status of an Commodity record to 'rejected'.
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
     * Update the status of an Commodity record to 'Active'.
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
     * Update the status of an Commodity record to 'Approved'.
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
