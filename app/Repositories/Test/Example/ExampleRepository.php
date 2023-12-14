<?php

namespace App\Repositories\Test\Example;

use Exception;
use App\Models\Test\Example;
use App\Http\Requests\Test\ExampleRequest;
use App\Repositories\Test\Example\RepoInterface\ExampleRepoInterface;

class ExampleRepository implements ExampleRepoInterface
{
    /**
     * Get the list of table columns for the data table
     *
     * @return array
     */
    public function getTableFields(): array
    {
        return Example::getTableFields();
    }

    /**
     * Get the list of form elements for the form builder
     *
     * @return array
     */
    public function getFormFields(): array
    {
        try {
            return Example::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * Add a single record in the table
     *
     * @param ExampleRequest $data
     *
     * @return Array
     */
    public function add(string $fileUrl, ExampleRequest $data)
    {
        try {
            Example::create([
                'Name' => $data->Name,
                'AboutMe' => $data->AboutMe,
                'CountryID' => $data->CountryID,
                'StateID' => $data->StateID,
                'Gender' => $data->Gender,
                'ProfilePhoto' => $fileUrl
            ]);
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Add multiple records in the table with bulk insert query.
     * Divide the inputs in chunks and make multiple queries.
     * TODO: Implement DTO
     */
    public function addMany(ExampleRequest $data)
    {
        try {
            return Example::insert($data->toArray());
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Find Example and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
        try {
            return Example::query()
                ->select(
                    'ID',
                    'Name',
                    'AboutMe',
                    'CountryID',
                    'StateID',
                    'ProfilePhoto',
                    'Gender'
                )
                ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                    $query->where($on, 'like', "%{$search}%");
                })
                ->when(count(explode(".", $on)) > 1, function ($query) use ($on, $search) {
                    $on = explode(".", $on);
                    $model = $on[0];
                    $on = $on[1];
                    $query->whereHas($model, function ($query2) use ($on, $search) {
                        $query2->where($on, 'like', "%{$search}%");
                    });
                })
                ->with('country:ID,Name','state:ID,Name')
                ->orderBy('id', 'desc')->paginate($rowsPerPage)
                ->appends(request()->query());
            } catch (Exception $e) {
                return $e;
            }
    }

    /**
     * Find all Example as per condition for dropdown listing
     *
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     */
    public function all(string $on = null, string $search = null)
    {
        try {
            return Example::query()
                ->select('ID','Name')
                ->when(!empty($on) && count(explode(".", $on)) == 1, function ($query) use ($on, $search) {
                    $query->where($on, '=', "{$search}");
                })
                ->orderBy('Name', 'desc')
                ->get();
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Retrieve an Example record by ID.
     *
     * @param int $id
     *
     * @return \App\Models\Example
     *
     */
    public function findById(int $id)
    {
        // TODO: resource dto
        try {
            return Example::select(['Name', 'AboutMe','CountryID','StateID', 'ProfilePhoto', 'Gender'])->where('ID', $id)->firstOrFail();
        } catch (Exception $e) {
            return $e;
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
    public function update(ExampleRequest $request, int $id)
    {
        try {
            $s3url = $request->input('ProfilePhoto');

            //update the record in db
            return Example::where('ID', $id)->update([
                'Name' => $request->Name,
                'AboutMe' => $request->AboutMe,
                'CountryID' => $request->CountryID,
                'StateID' => $request->StateID,
                'Gender' => $request->Gender,
                'ProfilePhoto' => $s3url
            ]);
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Soft delete a Example
     */
    public function delete()
    {
    }

    /**
     * Update the status of an Example record to 'Rejected'.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatusReject(array $id)
    {
        //update status
        try {
            $idcollection = collect($id);
            $idcollection->map(function (array $ids) {
                return Example::whereIn("ID", $ids)
                    ->update(['Status' => 'Rejected']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the status of an Example record to 'Active'.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatusFinalize(array $id)
    {
        //update status
        try {
            $idcollection = collect($id);
            $idcollection->map(function (array $ids) {
                return Example::whereIn("ID", $ids)
                    ->update(['Status' => 'Active']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the status of an Example record to 'Approved'.
     *
     * @param array $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatusApprove(array $id)
    {
        //update status
        try {
            $idcollection = collect($id);
            $idcollection->map(function (array $ids) {
                return Example::whereIn("ID", $ids)
                    ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
