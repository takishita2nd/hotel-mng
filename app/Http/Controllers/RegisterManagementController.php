<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repository\RegisterManagementRepository;
use App\Repository\RoomRepository;
use App\Http\Requests\ManagementRequest;

class RegisterManagementController extends Controller
{
    protected $registerManagement;
    protected $roomRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->registerManagement = new RegisterManagementRepository();
        $this->roomRepository = new RoomRepository();
    }

    /**
     * Show the Register.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(is_null($request->input('year')) || is_null($request->input('month')))
        {
            return view('register.index', ['registerLists' => $this->registerManagement->getList()]);
        }
        else
        {
            return view('register.index', 
                ['registerLists' => $this->registerManagement->getListByMonth($request->input('year'), $request->input('month'))]
            );
        }
    }

    /**
     * indexの月別表示
     *
     * @return \Illuminate\Http\Response
     */
    public function indexToMonthly(Request $request)
    {
        return redirect('management?year='.$request->year.'&month='.$request->month);
    }

    /**
     * 入力フォーム
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register.create',
                    ['rooms' => $this->roomRepository->getRoomList()]);
    }

    /**
     * 登録処理
     */
    public function store(ManagementRequest $request)
    {
        if($this->registerManagement->checkSchedule($request->start_day, $request->days) == false)
        {
            return redirect('management/create')
                        ->with(['error' => 'スケジュールが重複します'])
                        ->withInput();
        }
        $param = $this->registerManagement->getParam();
        $this->registerManagement->add([
            $param[0] => $request->name,
            $param[1] => $request->address,
            $param[2] => $request->phone,
            $param[3] => $request->num,
            $param[4] => $request->days,
            $param[5] => $request->start_day,
            $param[6] => false
        ], $request->room);
        return redirect('management');
    }

    /**
     * 編集処理
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('register.edit',
                    ['item' => $this->registerManagement->getReserveById($id),
                     'rooms' => $this->roomRepository->getRoomList()]);
    }

    /**
     * 更新処理
     */
    public function update(ManagementRequest $request)
    {
        if($this->registerManagement->checkScheduleForUpdate($request->start_day, $request->days, $request->id) == false)
        {
            return redirect('management/create')
                        ->with(['error' => 'スケジュールが重複します'])
                        ->withInput();
        }
        $param = $this->registerManagement->getParam();
        $this->registerManagement->updateById($request->id,
        [
            $param[0] => $request->name,
            $param[1] => $request->address,
            $param[2] => $request->phone,
            $param[3] => $request->num,
            $param[4] => $request->days,
            $param[5] => $request->start_day,
            $param[6] => false
        ], $request->room);
        return redirect('management');
    }

    /**
     * 削除確認
     *
     * @return \Illuminate\Http\Response
     */
    public function conform($id)
    {
        return view('register.conform', ['item' => $this->registerManagement->getReserveById($id)]);
    }

    /**
     * 削除処理
     */
    public function delete(Request $request)
    {
        $this->registerManagement->deleteById($request->id);
        return redirect('management');
    }

    /**
     * 宿泊処理確認
     *
     * @return \Illuminate\Http\Response
     */
    public function lodging(Request $request)
    {
        $this->registerManagement->lodging($request->id);
        return redirect('management');
    }

    /**
     * スケジュール表示
     */
    public function schedule(Request $request)
    {
        if(is_null($request->input('year')) || is_null($request->input('month')))
        {
            return view('register.schedule', ['Lists' => $this->registerManagement->getSchedule()]);
        }
        else
        {
            return view('register.schedule', 
                ['Lists' => $this->registerManagement->getScheduleByMonth($request->input('year'), $request->input('month'))]
            );
        }
    }

    /**
     * スケジュール表示の月別表示
     */
    public function scheduleToMonthly(Request $request)
    {
        return redirect('management/schedule?year='.$request->year.'&month='.$request->month);
    }

    /**
     * 月毎の集計を表示
     */
    public function total()
    {
        return view('register.total', ['Lists' => $this->registerManagement->countByMonthly()]);
    } 
}
