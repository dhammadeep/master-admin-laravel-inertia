<?php

namespace App\Repositories\General\ModeOfPayment\RepoInterface;

use App\Http\Requests\General\ModeOfPayment\ModeOfPaymentRequest;

interface ModeOfPaymentRepoInterface
{
    public function add(ModeOfPaymentRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(ModeOfPaymentRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
