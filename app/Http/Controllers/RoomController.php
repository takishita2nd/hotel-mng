<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\RoomRepository;
use App\Http\Requests\RoomRequest;

class RoomController extends Controller
{
    protected $room;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->room = new RoomRepository();
    }

    /**
     * 部屋一覧の表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('room.index', ['roomLists' => $this->room->getList()]);
    }

    /**
     * 入力フォーム
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('room.create');
    }

    /**
     * 登録処理
     */
    public function store(RoomRequest $request)
    {
        $param = $this->room->getParam();
        $this->room->add([
            $param[0] => $request->name,
            $param[1] => $request->price,
        ]);
        return redirect('room');
    }

    /**
     * 編集処理
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('room.edit', ['item' => $this->room->getItemById($id)]);
    }

    /**
     * 更新処理
     */
    public function update(RoomRequest $request)
    {
        $param = $this->room->getParam();
        $this->room->updateById($request->id,
        [
            $param[0] => $request->name,
            $param[1] => $request->price,
        ]);
        return redirect('room');
    }

    /**
     * 削除確認
     *
     * @return \Illuminate\Http\Response
     */
    public function conform($id)
    {
        return view('room.conform', ['item' => $this->room->getItemById($id)]);
    }

    /**
     * 削除処理
     */
    public function delete(Request $request)
    {
        $this->room->deleteById($request->id);
        return redirect('room');
    }

}
