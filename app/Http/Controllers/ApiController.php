<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Repository\RegisterManagementRepository;
use App\Repository\RoomRepository;
use App\Repository\UserRepository;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->registerManagement = new RegisterManagementRepository();
        $this->room = new RoomRepository();
        $this->user = new UserRepository();
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
            $request->room,
            Auth::user()->id
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
            $param[0] => $request->contents["num"],
            $param[1] => $request->contents["days"],
            $param[2] => $request->contents["start_day"],
            $param[3] => false,
            $param[4] => date('Y-m-d H:i', strtotime($request->contents["start_day"].' + '.$request->contents["days"].' day') + $request->contents["checkout"])
        ], $request->contents["roomid"]);
        return response()->json(['registerLists' => $this->registerManagement->getListByMonth(
            $request->year,
            $request->month,
            $request->room,
            Auth::id()
        )]);
    }

    public function delete(Request $request)
    {
        $this->registerManagement->deleteById($request->id, Auth::user());
        return response()->json(['registerLists' => $this->registerManagement->getListByMonth(
            $request->year,
            $request->month,
            $request->room,
            Auth::user()
        )]);
    }

    public function role(Request $request)
    {
        return response()->json(['role' => Gate::Allows('manager'),
                                 'user' => Auth::user()]);
    }

    public function users(Request $request)
    {
        return response()->json(['users' => $this->user->search($request->search)]);
    }

    public function add(Request $request)
    {
        \Log::debug(print_r($request->contents, true));
        if($this->registerManagement->checkSchedule($request->contents["start_day"], 
                                                    $request->contents["days"], 
                                                    $request->contents["roomid"]) == false)
        {
            return response()->json([
                'errors' => "スケジュールが重複しています"
            ], 400);
        }
        $param = $this->registerManagement->getParam();
        $this->registerManagement->add([
            $param[0] => $request->contents["num"],
            $param[1] => $request->contents["days"],
            $param[2] => $request->contents["start_day"],
            $param[3] => false,
            $param[4] => date('Y-m-d H:i', strtotime($request->contents["start_day"].' + '.$request->contents["days"].' day') + $request->contents["checkout"])
        ], $request->contents["roomid"], $this->user->getUserById($request->contents["id"]));
        return response()->json();
    }
}
