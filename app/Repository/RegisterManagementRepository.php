<?php

namespace App\Repository;

use App\Model\ReserveManagement;

class RegisterManagementRepository
{
    // 予約一覧を取得する
    public function getList()
    {
        return ReserveManagement::all();
    }
}