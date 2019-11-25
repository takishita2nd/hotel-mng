<?php

namespace App\Repository;

use App\Model\ReserveManagement;

class RegisterManagementRepository
{
    private $paramNames = ['name', 'address', 'phone', 'num', 'days', 'start_day'];

    /**
     * 予約一覧を取得する
     * 
     * @return ReserveManagement[]
     */
    public function getList()
    {
        return ReserveManagement::all();
    }

    /**
     * 予約を登録する
     * 
     * @return void
     */
    public function add($param)
    {
        $model = new ReserveManagement;
        foreach($this->paramNames as $name)
        {
            $model->$name = $param[$name];
        }
        $model->save();
    }

    /**
     * IDから予約を１件取得する
     * 
     * @return ReserveManagement
     */
    public function getItemById($id)
    {
        return ReserveManagement::where(['id' => $id])->first();
    }

    /**
     * 予約を更新する
     * 
     * @return void
     */
    public function updateById($id, $param)
    {
        $model = $this->getItemById($id);
        foreach($this->paramNames as $name)
        {
            $model->$name = $param[$name];
        }
        $model->save();
    }

    /**
     * 予約を削除する
     * 
     * @return void
     */
    public function deleteById($id)
    {
        $model = $this->getItemById($id);
        $model->delete();
    }

    public function getParam()
    {
        return $this->paramNames;
    }
}