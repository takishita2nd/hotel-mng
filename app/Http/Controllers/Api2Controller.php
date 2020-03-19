<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repository\RegisterManagementRepository;
use App\Repository\RoomRepository;
use App\Repository\UserRepository;

class Api2Controller extends Controller
{
    public function __construct()
    {
        $this->registerManagement = new RegisterManagementRepository();
        $this->room = new RoomRepository();
        $this->user = new UserRepository();
    }

    public function unlock(Request $request)
    {
        \Log::debug(print_r($request->input('number'), true));
        \Log::debug(print_r($request->input('room'), true));

        $registers = $this->registerManagement->getItemsByDate(date('Y-m-d'));
        if(is_null($registers) == false)
        {
            foreach ($registers as $register)
            {
                $room = $register->rooms()->first();
                if(is_null($room) == false)
                {
                    if($room->id == $request->input('room') &&
                        strcmp($register->lock_number, $request->input('number')) == 0)
                    {
                        return response()->json(['result' => true]);
                    }
                }
            }
        }
        return response()->json(['result' => false]);
    }
}
