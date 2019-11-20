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
}
