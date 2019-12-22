<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\RegisterManagementRepository;
use App\Repository\RoomRepository;

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
}
