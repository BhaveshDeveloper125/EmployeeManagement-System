<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeWatcher;
use App\Models\ExtraUserData;
use App\Models\Holidays;
use App\Models\User;
use App\Models\UserWifiData;
use Cron\HoursField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

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
        // $MergedData = EmployeeTimeWatcher::join('extra_user_data', 'employee_time_watchers.user_id', '=', 'extra_user_data.user_id')
        //     ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
        //     ->select(
        //         'employee_time_watchers.user_id',
        //         'employee_time_watchers.entry',
        //         'employee_time_watchers.leave',
        //         'extra_user_data.post',
        //         'extra_user_data.mobile',
        //         'extra_user_data.address',
        //         'extra_user_data.qualificatio',
        //         'users.name',
        //     )
        //     ->get();


        try {
            $users = User::with('extraUserData')->get();
            $MergedData = [];
            foreach ($users as $i) {
                foreach ($i->extraUserData as $j) {
                    $MergedData[] = [
                        'id' => $i->id,
                        'name' => $i->name,
                        'post' => $j->post,
                        'mobile' => $j->mobile,
                        'address' => $j->address,
                        'qualificatio' => $j->qualificatio
                    ];
                }
            }
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error fetching employee data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while fetching employee data.');
        }
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


        $user_email = User::latest()->first()->email;
        if ($userData->save()) {
            try {
                $to = $user_email;
                $msg = "new User is added ";
                $subject = "This Email subject is about adding a new user";
                Mail::to($to)->send(new WelcomeEmail($msg, $subject));
            } catch (Exception $e) {
                print $e;
                return response()->json('User data is registered but the email is not sent');
            }
            return redirect()->route('generate.user')->with('registration_success', true);
        } else {
            return redirect()->route('generate.user')->with('unsuccess', true);
        }
    }

    public function SearchUser(Request $request)
    {
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


        // $alldata = DB::table('combined_user_data')->where('name', 'like', '%' . $request->name . '%')->get();
        // return redirect()->route('searchUser')->with('alldata', $alldata);
        return view('SearchEmployee', ['alldata' => $MergedData]);
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

    public function DeleteEmpDatas($id)
    {
        $extra_deleteuser = ExtraUserData::where('user_id', $id)->delete();
        $deleteuser = User::destroy($id);
        if ($extra_deleteuser && $deleteuser) {
            return redirect()->back();
        } else {
            return response("<script> alert('User is not deleted please try again later...') </script>");
        }
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

    public function apigetData()
    {
        // $MergedData = EmployeeTimeWatcher::join('extra_user_data', 'employee_time_watchers.user_id', '=', 'extra_user_data.user_id')
        //     ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
        //     ->select(
        //         'employee_time_watchers.user_id',
        //         'employee_time_watchers.entry',
        //         'employee_time_watchers.leave',
        //         'extra_user_data.post',
        //         'extra_user_data.mobile',
        //         'extra_user_data.address',
        //         'extra_user_data.qualificatio',
        //         'users.name',
        //     )
        //     ->get();

        try {
            $users = User::with('extraUserData')->get();
            $MergedData = [];
            foreach ($users as $i) {
                foreach ($i->extraUserData as $j) {
                    $MergedData[] = [
                        'id' => $i->id,
                        'name' => $i->name,
                        'post' => $j->post,
                        'mobile' => $j->mobile,
                        'address' => $j->address,
                        'qualificatio' => $j->qualificatio
                    ];
                }
            }
            return response()->json([$MergedData]);
        } catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error fetching employee data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while fetching employee data.');
        }
    }


    public function apiSearchUser(Request $request)
    {
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


        $alldata = DB::table('combined_user_data')->where('name', 'like', '%' . $request->name . '%')->get();
        // return redirect()->route('searchUser')->with('alldata', $alldata);
        return response()->json(['alldata' => $alldata]);
    }

    public function AddWifiData(Request $request)
    {
        $validation = $request->validate([
            'wifi_name' => 'required | string | max:255',
            'ssid' => 'required | string | max:255',
            'ip' => 'required | string | max:255',
            'gateway' => 'required | string | max:255',
        ]);

        try {
            $UserWifiData_Instance = new UserWifiData();
            $UserWifiData_Instance->fill($validation);

            $save = $UserWifiData_Instance->save();

            if ($save) {
                return response()->json('Data Stored Successfully');
            } else {
                return response()->json('oops something went wrong , cant store the data');
            }
        } catch (Exception $e) {
            return response()->json('Error : ' . $e->getMessage());
        }
    }

    public function GetWifi()
    {
        $data = UserWifiData::all();
        return response()->json($data);
    }
}
