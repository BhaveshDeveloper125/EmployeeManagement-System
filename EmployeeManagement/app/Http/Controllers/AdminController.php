<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeWatcher;
use App\Models\ExtraUserData;
use App\Models\Holidays;
use App\Models\User;
use Cron\HoursField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function hello()
    {
        $MergedData = EmployeeTimeWatcher::join('extra_user_data', 'employee_time_watchers.user_id', '=', 'extra_user_data.user_id')
            ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
            ->select(
                'employee_time_watchers.user_id',
                'employee_time_watchers.entry',
                'employee_time_watchers.leave',
                'extra_user_data.post',
                'extra_user_data.mobile',
                'extra_user_data.address',
                'extra_user_data.qualificatio',
                'users.name',
            )
            ->get();
        $user = User::count();
        $todayAttendance = EmployeeTimeWatcher::whereDate('entry', Carbon::today())->count();
        $lateEmployees = EmployeeTimeWatcher::whereDate('entry', Carbon::today())->whereTime('entry', '>', '10:10:00')->count();
        $employeeTime = EmployeeTimeWatcher::whereDate('leave', Carbon::today())->count();
        $earlyLeave = EmployeeTimeWatcher::whereDate('leave', Carbon::today())->whereTime('leave', '<', '19:00')->count();
        return view('Admin', ['data' => $MergedData, 'userData' => $user, 'leaveToday' => $employeeTime, 'lateEmp' => $lateEmployees, 'presentToday' => $todayAttendance, 'earlyLeave' => $earlyLeave, 'absent' => $user - $todayAttendance]);
    }

    public function getData()
    {
        $MergedData = EmployeeTimeWatcher::join('extra_user_data', 'employee_time_watchers.user_id', '=', 'extra_user_data.user_id')
            ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
            ->select(
                'employee_time_watchers.user_id',
                'employee_time_watchers.entry',
                'employee_time_watchers.leave',
                'extra_user_data.post',
                'extra_user_data.mobile',
                'extra_user_data.address',
                'extra_user_data.qualificatio',
                'users.name',
            )
            ->get();
        return view('EmployeeRecord', ['data' => $MergedData]);
    }

    public function AddUsers(Request $request)
    {
        $request->validate([
            'name' => 'required | string | max:255',
            'email' => 'required | string | email | max:255 | unique:users',
            'password' => 'required | string | min:8'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            $user = User::latest()->first();
            return view('EployeeDetails', ['data' => $user]);
        }
        print_r($request->all());
    }

    public function GetLatestUser()
    {
        $user = User::latest()->first();
        // dd($user);
        return view('EployeeDetails', ['data' => $user]);
    }

    public function AddUserDetails(Request $request)
    {

        $userData = new ExtraUserData();

        $userData->fill($request->all());

        if ($userData->save()) {
            return response()->json(["message" => "User created Successfuly"]);
        } else {
            return response()->json(["message" => "User not created"]);
        }
    }

    public function SearchUser(Request $request)
    {
        $alldata = DB::table('combined_user_data')->where('name', 'like', '%' . $request->name . '%')->get();
        $user = User::where('name', 'like', '%' . $request->name . '%')->get();
        $user_id = $user->pluck('id')->toArray();
        $EmployeeTime = EmployeeTimeWatcher::whereIn('user_id', $user_id)->get();



        $MergedData = EmployeeTimeWatcher::join('extra_user_data', 'employee_time_watchers.user_id', '=', 'extra_user_data.user_id')
            ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
            ->select(
                'employee_time_watchers.user_id',
                'employee_time_watchers.entry',
                'employee_time_watchers.leave',
                'extra_user_data.post',
                'extra_user_data.mobile',
                'extra_user_data.address',
                'extra_user_data.qualificatio',
                'users.name',
            )
            ->get();

        $todayAttendance = EmployeeTimeWatcher::whereDate('entry', Carbon::today())->count();
        $lateEmployees = EmployeeTimeWatcher::whereDate('entry', Carbon::today())->whereTime('entry', '>', '10:10:00')->count();
        $employeeTime = EmployeeTimeWatcher::whereDate('leave', Carbon::today())->count();

        return view('Download', ['alldata' => $alldata]);
    }

    public function EditEmpData()
    {
        return view('EditEmpData');
    }

    public function EditEmpDatas($id)
    {
        $extraUserData = ExtraUserData::where('user_id', $id)->get();
        // return response()->json($extraUserData);
        return view('EditEmpData', ['data' => $extraUserData]);
    }

    public function SaveEditEmpDatas(Request $request, $id)
    {
        $user = ExtraUserData::find($id);
        $user->post = $request->post;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->qualificatio = $request->qualificatio;
        $user->exp = $request->exp;
        $user->isAdmin = $request->isAdmin;

        if ($user->save()) {
            return response()->json("User Datas are Updated...");
        } else {
            return response()->json("Fails : User Datas are not Updated...");
        }
        // return response()->json($request->all());
    }

    public function APIhello()
    {
        $MergedData = EmployeeTimeWatcher::join('extra_user_data', 'employee_time_watchers.user_id', '=', 'extra_user_data.user_id')
            ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
            ->select(
                'employee_time_watchers.user_id',
                'employee_time_watchers.entry',
                'employee_time_watchers.leave',
                'extra_user_data.post',
                'extra_user_data.mobile',
                'extra_user_data.address',
                'extra_user_data.qualificatio',
                'users.name',
            )
            ->get();
        $user = User::count();
        $todayAttendance = EmployeeTimeWatcher::whereDate('entry', Carbon::today())->count();
        $lateEmployees = EmployeeTimeWatcher::whereDate('entry', Carbon::today())->whereTime('entry', '>', '10:10:00')->count();
        $employeeTime = EmployeeTimeWatcher::whereDate('leave', Carbon::today())->count();
        $earlyLeave = EmployeeTimeWatcher::whereDate('leave', Carbon::today())->whereTime('leave', '<', '19:00')->count();
        return response()->json(['data' => $MergedData, 'userData' => $user, 'leaveToday' => $employeeTime, 'lateEmp' => $lateEmployees, 'presentToday' => $todayAttendance, 'earlyLeave' => $earlyLeave, 'absent' => $user - $todayAttendance]);
    }

    public function APIAddUserDetails(Request $request)
    {

        $userData = new ExtraUserData();

        $userData->fill($request->all());

        if ($userData->save()) {
            return response()->json(["message" => "User created Successfuly"]);
        } else {
            return response()->json(["message" => "User not created"]);
        }
    }

    public function Holidays(Request $request)
    {
        $HoliDay = new Holidays();

        return response()->json([$request->all()]);
    }
}
