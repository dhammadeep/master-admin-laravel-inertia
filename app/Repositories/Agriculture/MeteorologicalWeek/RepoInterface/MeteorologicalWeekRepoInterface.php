<?php

namespace App\Repositories\Agriculture\MeteorologicalWeek\RepoInterface;

use App\Http\Requests\Agriculture\MeteorologicalWeek\MeteorologicalWeekRequest;

interface MeteorologicalWeekRepoInterface
{
    public function add(MeteorologicalWeekRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(MeteorologicalWeekRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
