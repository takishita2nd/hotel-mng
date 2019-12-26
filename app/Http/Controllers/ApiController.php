<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\RegisterManagementRepository;
use App\Repository\RoomRepository;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->registerManagement = new RegisterManagementRepository();
        $this->room = new RoomRepository();
    }

    public function rooms(Request $request)
    {
        return response()->json(['roomLists' => $this->room->getList()]);
    }

    public function registers(Request $request)
    {
        return response()->json(['registerLists' => $this->registerManagement->getListByMonth(
            $request->year,
            $request->month,
            $request->room
        )]);
    }

    public function timelist(Request $request)
    {
        return response()->json(['timelist' => $this->registerManagement->getTimeList()]);
    }

    public function update(Request $request)
    {
        \Log::debug(print_r($request->contents, true));
        if($this->registerManagement->checkScheduleForUpdate($request->contents["start_day"], 
                                                            $request->contents["days"], 
                                                            $request->contents["id"], 
                                                            $request->contents["roomid"]) == false)
        {
            \Log::debug("スケジュールが重複しています");
            return response()->json([
                'errors' => "スケジュールが重複しています"
            ], 400);
        }
        $param = $this->registerManagement->getParam();
        $this->registerManagement->updateById($request->contents["id"],
        [
            $param[0] => $request->contents["name"],
            $param[1] => $request->contents["address"],
            $param[2] => $request->contents["phone"],
            $param[3] => $request->contents["num"],
            $param[4] => $request->contents["days"],
            $param[5] => $request->contents["start_day"],
            $param[6] => false,
            $param[7] => date('Y-m-d H:i', strtotime($request->contents["start_day"].' + '.$request->contents["days"].' day') + $request->contents["checkout"])
        ], $request->contents["roomid"]);
        return response()->json(['registerLists' => $this->registerManagement->getListByMonth(
            $request->year,
            $request->month,
            $request->room
        )]);
    }

    public function delete(Request $request)
    {
        $this->registerManagement->deleteById($request->id);
        return response()->json(['registerLists' => $this->registerManagement->getListByMonth(
            $request->year,
            $request->month,
            $request->room
        )]);
    }
}
