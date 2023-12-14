<?php

namespace App\Services\Test\Example;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Test\ExampleRequest;
use SebastianBergmann\Comparator\Exception;
use App\Repositories\Test\Example\ExampleRepository;
use App\Http\Resources\Test\Example\List\ExampleListResource;
use App\Http\Resources\Test\Example\Table\ExampleTableCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ExampleService
{
    protected $repository;

    /**
     * Constructor based dependency injection
     *
     * @param ExampleRepository $repository
     *
     * @return void
     */
    public function __construct(ExampleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list of all records separated by pagination
     *
     * @param String $on The field to search
     * @param String $search The value to search with a like '%%' wildcard
     *
     * @return ExampleCollection
     */
    public function getAllPaginatedTableData(String $on = null, String $search = null)
    {
        // Get number of rows to display in a DataTable
        // from the global configuration
        $rowsPerPage = config('custom.dataTablePagination');

        // Return in the given API resource format
        return new ExampleTableCollection($this->repository->find($on, $search, $rowsPerPage));
    }

    /**
     * Return all data in the list resource format
     *
     * @param String $on Search field
     * @param String $search Search topic
     *
     * @return  ExampleTableCollection
     */
    public function getAllRecords($on = "", $search = "")
    {
        return new ExampleTableCollection(
            $this->repository->all($on, $search)
        );
    }

    /**
     * Add a new Example in the DB
     *
     * @param ExampleRequest $data
     *
     * @return Array
     */
    public function add(string $fileUrl, ExampleRequest  $data)
    {
        try {
            if ($fileUrl) {
                //set image field
                $data->merge([
                    'ProfilePhoto' => $fileUrl,
                ]);
            }
            return $this->repository->add($fileUrl, $data);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function S3ImageUpload(Request $request)
    {
        try {
            $path = $request->file('ProfilePhoto')->store('images', 's3');
            $filePath_normal = 'photo/' . $request->file('ProfilePhoto')->hashName();
            $filePath_thumb = 'thumbnails/' . $request->file('ProfilePhoto')->hashName();
            $image_normal = Image::make($request->file('ProfilePhoto'))->widen(800, function ($constraint) {
                $constraint->upsize();
            });
            $image_thumb = Image::make($request->file('ProfilePhoto'))->crop(100, 100);
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
            $example = $this->repository->findById($id);
            $imgUrl = parse_url($example->ProfilePhoto);
            Storage::disk('s3')->delete($imgUrl['path']);
            $photo = parse_url(Str::replace('images/', 'photo/', $example->ProfilePhoto));
            Storage::disk('s3')->delete($photo['path']);
            $thumbnails = parse_url(Str::replace('images/', 'thumbnails/', $example->ProfilePhoto));
            Storage::disk('s3')->delete($thumbnails['path']);
            return true;
            // return $request->file('ProfilePhoto')->delete('images', 's3');
        } catch (BadRequestException $e) {
            throw $e;
        } catch (NotFoundHttpException $e) {
            throw $e;
        }
    }

    /**
     * Render the edit view for the Example model.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function findExampleById(int $id)
    {

        try {
            // return $this->repository->findById($id);
            return collect(new ExampleListResource($this->repository->findById($id)));
        } catch (NotFoundHttpException $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param \App\Http\Requests\Test\ExampleRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ExampleRequest $request, $fileUrl, int $id)
    {
        try {
            // Retrieve the Example from the database
            $example = $this->repository->findById($id);
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

            if (!$example) {
                throw new \InvalidArgumentException('Example not found.');
            }
            return $this->repository->update($request, $id, $fileUrl);
        } catch (NotFoundHttpException $e) {
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
        return $this->repository->getTableFields();
    }

    /**
     * Get the dynamic form elements
     *
     * @return array
     */
    public function getFormFields(): array
    {
        return $this->repository->getFormFields();
    }

    /**
     * Update the status of an Example record to 'rejected'.
     *
     * @param array $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateRejectStatus(array $id)
    {
        return $this->repository->updateStatusReject(array($id));
    }

    /**
     * Update the status of an Example record to 'Active'.
     *
     * @param array $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateFinalizeStatus(array $id)
    {
        return $this->repository->updateStatusFinalize(array($id));
    }

    /**
     * Update the status of an Example record to 'Approved'.
     *
     * @param array $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateApproveStatus(array $id)
    {
        return $this->repository->updateStatusApprove(array($id));
    }
}
