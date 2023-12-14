<?php

namespace App\Services\Commodity\CommodityPlantPart;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Http\Requests\Commodity\CommodityPlantPart\CommodityPlantPartRequest;
use App\Repositories\Commodity\CommodityPlantPart\CommodityPlantPartRepository;
use App\Http\Resources\Commodity\CommodityPlantPart\Lists\CommodityPlantPartListResource;
use App\Http\Resources\Commodity\CommodityPlantPart\Table\CommodityPlantPartTableCollection;


class CommodityPlantPartService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param CommodityPlantPartRepository $repository
     *
     * @return void
     */
    public function __construct(CommodityPlantPartRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return CommodityPlantPartCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');
        try {
            // Return in the given API resource format
            return new CommodityPlantPartTableCollection($this->repository->find($on, $search, $rowsPerPage));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Creates a new CommodityPlantPart in the DB
     *
     * @param CommodityPlantPartRequest $data
     *
     * @return Array
     */
    public function add(string $fileUrl,CommodityPlantPartRequest $data )
    {
        try {
            if ($fileUrl) {
                //set image field
                $data->merge([
                    'FileUrl' => $fileUrl,
                ]);
            }
            return $this->repository->add($fileUrl,$data);
        } catch (BadRequestException $e) {
            throw $e;
        } catch (NotFoundHttpException $e) {
            throw $e;
        }  catch (Exception $e) {
            throw $e;
        }
    }

    public function S3ImageUpload(Request $request)
    {
        try {
            $path = $request->file('FileUrl')->store('images', 's3');
            $filePath_normal = 'photo/' . $request->file('FileUrl')->hashName();
            $filePath_thumb = 'thumbnails/' . $request->file('FileUrl')->hashName();
            $image_normal = Image::make($request->file('FileUrl'))->widen(800, function ($constraint) {
                $constraint->upsize();
            });
            $image_thumb = Image::make($request->file('FileUrl'))->crop(100, 100);
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
            $commodityPlantPart = $this->repository->findById($id);
            $imgUrl = parse_url($commodityPlantPart->FileUrl);
            Storage::disk('s3')->delete($imgUrl['path']);
            $photo = parse_url(Str::replace('images/', 'photo/', $commodityPlantPart->FileUrl));
            Storage::disk('s3')->delete($photo['path']);
            $thumbnails = parse_url(Str::replace('images/', 'thumbnails/', $commodityPlantPart->FileUrl));
            Storage::disk('s3')->delete($thumbnails['path']);
            return true;
            // return $request->file('FileUrl')->delete('images', 's3');
        } catch (BadRequestException $e) {
            throw $e;
        } catch (NotFoundHttpException $e) {
            throw $e;
        }
    }

    /**
     * Render the edit view for the CommodityPlantPart model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findCommodityPlantPartById(int $id)
    {
        try {
            //return $this->repository->findById($id);
            return collect(new CommodityPlantPartListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param CommodityPlantPartRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommodityPlantPartRequest $request, $fileUrl, int $id)
    {
        // Retrieve the CommodityPlantPart from the database
       try {
        $commodityplantpart = $this->repository->findById($id);
        if ($fileUrl) {
            $request->merge([
                'FileUrl' => $fileUrl,
            ]);
            $path = $request->file('FileUrl')->store('images', 's3');
            $filePath_normal = 'photo/' . $request->file('FileUrl')->hashName();
            $filePath_thumb = 'thumbnails/' . $request->file('FileUrl')->hashName();
            $image_normal = Image::make($request->file('FileUrl'))->widen(800, function ($constraint) {
                $constraint->upsize();
            });
            $image_thumb = Image::make($request->file('FileUrl'))->crop(100, 100);
            Storage::disk('s3')->put($filePath_normal, $image_normal->stream());
            Storage::disk('s3')->put($filePath_thumb, $image_thumb->stream());
            Storage::disk('s3')->url($path);
        }
        if ($commodityplantpart) {
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
        }  catch (Exception $e) {
            throw $e;
        }
    }

    /**

     * Update the status of an CommodityPlantPart record to 'rejected'.
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
     * Update the status of an CommodityPlantPart record to 'Active'.
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
     * Update the status of an CommodityPlantPart record to 'Approved'.
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
