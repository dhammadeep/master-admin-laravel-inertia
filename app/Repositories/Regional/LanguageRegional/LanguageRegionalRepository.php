<?php

namespace App\Repositories\Regional\LanguageRegional;

use Exception;
use App\Models\Geographical\Region;
use App\Models\Regional\LanguageRegional;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Geographical\Region\RegionRepository;
use App\Http\Resources\Geographical\Region\Lists\RegionListCollection;
use App\Http\Requests\Regional\LanguageRegional\LanguageRegionalRequest;
use App\Repositories\Regional\LanguageRegional\RepoInterface\LanguageRegionalRepoInterface;
use Maatwebsite\Excel\Excel;

class LanguageRegionalRepository implements LanguageRegionalRepoInterface
{
    protected $regionRepository;

    /**
     * Injects RegionRepository Service dependency through the constructor
     *
     * @param LanguageRegionalService $service
     *
     * @return Void
     */
    public function __construct(RegionRepository $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    /**
     * Find LanguageRegionals and get results in pagination
     * @param string $on The field to search
     * @param string $search The value to search with a like '%%' wildcard
     * @param int $rowsPerPage Number of rows to display in a page
     */
    public function find(string $on = null, string $search = null, int $rowsPerPage = 50)
    {
         try {
            return LanguageRegional::query()
            ->select('ID','StateCode','LanguageID','Status')
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
            ->with('State:ID,Name','Language:ID,Name')
            ->orderBy('id', 'desc')->paginate($rowsPerPage)
            ->appends(request()->query());

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the list of table columns for the data table
     *
     * @return array
     */
    public function getTableFields(): array
    {
        try {
            return LanguageRegional::getTableFields();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the list of form elements for the form builder
     *
     * @return array
     */
    public function getFormFields(): array
    {
        try {
            return LanguageRegional::getFormFields();
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * Add a single record in the table
     *
     * @param LanguageRegionalRequest $data
     *
     * @return Array
     */
    public function add(LanguageRegionalRequest $data)
    {
        try {
            //Create a new entry in db
            LanguageRegional::create([
                'StateCode' => $data->StateCode,
                'LanguageID' => $data->LanguageID,
            ]);

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find record by ID
     * @param int $id
     */
    public function findById(int $id)
    {
        try {
            return LanguageRegional::select('ID','StateCode','LanguageID')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
           throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in db.
     *
     * @param LanguageRegionalRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LanguageRegionalRequest $request, int $id)
    {
        try {
            $languageRegional = LanguageRegional::find($id);
            $languageRegional->Name = $request->Name;
            $languageRegional->save();
            return $languageRegional;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the list of ids from request
     *
     * @return array
     */
    public function updateStatusReject(array $id)
    {
        try {
            $idcollection = collect($id);

            $idcollection->map(function (array $ids) {
            return LanguageRegional::whereIn("ID", $ids)
                ->update(['Status' => 'Rejected']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the list of ids from request
     *
     * @return array
     */
    public function updateStatusFinalize(array $id)
    {
        try {
            $idcollection = collect($id);

            $idcollection->map(function (array $ids) {
            return LanguageRegional::whereIn("ID", $ids)
                ->update(['Status' => 'Active']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the list of ids from request
     *
     * @return array
     */
    public function updateStatusApprove(array $id)
    {
        try {
            $idcollection = collect($id);

            $idcollection->map(function (array $ids) {
            return LanguageRegional::whereIn("ID", $ids)
                ->update(['Status' => 'Approved']);
            })->all();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
