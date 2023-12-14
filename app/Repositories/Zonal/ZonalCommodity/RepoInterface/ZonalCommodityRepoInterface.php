<?php

namespace App\Repositories\Zonal\ZonalCommodity\RepoInterface;

use App\Http\Requests\Zonal\ZonalCommodity\ZonalCommodityRequest;

interface ZonalCommodityRepoInterface
{
    public function add(ZonalCommodityRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function allPhenophaseByZonalCommodity(string $on = null, string $search = null);

    public function allStressByZonalCommodityAndStressType(int $zonalCommodityId = null, int $stressType = null);

    public function allAgrochemicalByZonalCommodity(string $on = null, string $search = null);

    public function allZonalMeteorologicalWeekByZonalCommodity(string $fieldName = null, string $on = null, string $search = null);

    public function findById(int $id);

    public function update(ZonalCommodityRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
