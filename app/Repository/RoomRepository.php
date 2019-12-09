<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Model\Room;
use App\Model\ReserveManagement;

class RoomRepository
{
    private $paramNames = ['name', 'price'];

    /**
     * 部屋一覧を取得する
     * 
     * @return Room[]
     */
    public function getList()
    {
        return Room::get();
    }

    /**
     * 部屋を登録する
     * 
     * @return void
     */
    public function add($param)
    {
        $model = new Room;
        foreach($this->paramNames as $name)
        {
            $model->$name = $param[$name];
        }
        $model->save();
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

    /**
     * IDから部屋情報を１件取得する
     * 
     * @return Room
     */
    public function getItemById($id)
    {
        return Room::where(['id' => $id])->first();
    }

    public function getParam()
    {
        return $this->paramNames;
    }

}
