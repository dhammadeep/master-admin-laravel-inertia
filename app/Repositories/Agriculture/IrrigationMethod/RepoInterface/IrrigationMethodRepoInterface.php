<?php

namespace App\Repositories\Agriculture\IrrigationMethod\RepoInterface;

use App\Http\Requests\Agriculture\IrrigationMethod\IrrigationMethodRequest;

interface IrrigationMethodRepoInterface
{
    public function add(IrrigationMethodRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(IrrigationMethodRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
