<?php

namespace App\Repository;

use App\Model\ReserveManagement;

class RegisterManagementRepository
{
    private $paramNames = ['name', 'address', 'phone', 'num', 'days', 'start_day'];

    // 予約一覧を取得する
    public function getList()
    {
        return ReserveManagement::all();
    }

    // 予約を登録する
    public function add($param)
    {
        $model = new ReserveManagement;
        foreach($this->paramNames as $name)
        {
            $model->$name = $param[$name];
        }
        $model->save();
    }

    public function getParam()
    {
        return $this->paramNames;
    }
}