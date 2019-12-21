<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\RoomRepository;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->room = new RoomRepository();
    }

    public function rooms(Request $request)
    {
        return response()->json(['roomLists' => $this->room->getList()]);
    }
}
