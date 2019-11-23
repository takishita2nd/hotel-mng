<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\RegisterManagementRepository;

class RegisterManagementController extends Controller
{
    protected $registerManagement;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->registerManagement = new RegisterManagementRepository();
    }

    /**
     * Show the Register.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register.index', ['registerLists' => $this->registerManagement->getList()]);
    }

    /**
     * 入力フォーム
     */
    public function create()
    {
        return view('register.create');
    }

    /**
     * 登録処理
     */
    public function store(Request $request)
    {
        $param = $this->registerManagement->getParam();
        $this->registerManagement->add([
            $param[0] => $request->name,
            $param[1] => $request->address,
            $param[2] => $request->phone,
            $param[3] => $request->num,
            $param[4] => $request->days,
            $param[5] => $request->start_day
        ]);
        return redirect('management');
    }
}
