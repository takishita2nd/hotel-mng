<?php

namespace App\Repository;

use App\Model\ReserveManagement;
use App\Model\ReserveDayList;

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
        $model2 = new ReserveDayList();
        $model2->day = $model->start_day;
        $model2->save();
        $model->reserveDayLists()->attach($model2);
        for($i = 1; $i < $model->days; $i++)
        {
            $model2 = new ReserveDayList();
            $model2->day = date('Y-m-d', strtotime($model->start_day.'+'.$i.' day'));
            $model2->save();
            $model->reserveDayLists()->attach($model2);
        }
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
        $model2s = $model->reserveDayLists()->get();
        $model->reserveDayLists()->detach();
        foreach($model2s as $model2)
        {
            $model2->delete();
        }
        $model->delete();
    }

    public function getParam()
    {
        return $this->paramNames;
    }
}