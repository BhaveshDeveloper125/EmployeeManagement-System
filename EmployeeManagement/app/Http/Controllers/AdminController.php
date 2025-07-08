<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeWatcher;
use App\Models\ExtraUserData;
use App\Models\Holiday;
use App\Models\User;
use App\Models\UserWifiData;
use Cron\HoursField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Models\Leave;
use App\Models\SetTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $lateEmployees = EmployeeTimeWatcher::whereDate('entry', Carbon::today())->whereTime('entry', '>', SetTime::value('from'))->count();
        $employeeTime = EmployeeTimeWatcher::whereDate('leave', Carbon::today())->count();
        $earlyLeave = EmployeeTimeWatcher::whereDate('leave', Carbon::today())->whereTime('leave', '<', SetTime::value('to'))->count();
        $HolidayNumbers = Holiday::whereYear('leaves', Carbon::now()->year)->whereMonth('leaves', Carbon::now()->month)->count();

        return view('Admin', ['data' => $MergedData, 'userData' => $user, 'leaveToday' => $employeeTime, 'lateEmp' => $lateEmployees, 'presentToday' => $todayAttendance, 'earlyLeave' => $earlyLeave, 'absent' => $user - $todayAttendance, 'HolidayNumbers' => $HolidayNumbers]);
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
        // dd($MergedData);
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

        if (Carbon::parse($request->joining_date)->year == Carbon::today()->year) {
            $userData->leaves = 12 - Carbon::parse($request->joining_date)->month;
        } else {
            $userData->leaves = 12;
        }

        $userData->fill($request->all());


        $user_email = User::latest()->first()->email;
        if ($userData->save()) {
            try {
                $to = $user_email;
                $msg = nl2br("We are thrilled to welcome you to PurvSoft Tech! Your skills and experience make you a valuable addition to our team, and we're excited to see the contributions you'll bring. At PurvSoft Tech, we foster collaboration, innovation, and growth, and we hope you'll find this journey rewarding.\n\n
                Feel free to explore, ask questions, and connect with your colleagues—we're here to support you every step of the way. Looking forward to achieving great things together!\n\n\n\n
                Warm regards,\n
                PurvSoft Tech");
                $subject = "Welcome to PurvSoft Tech";
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


        $search = User::where('name', 'LIKE', "%$request->name%")->with('extraUserData')->get();




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
        return view('SearchEmployee', ['alldata' => $search]);
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
        $deleteuser = User::find($id)->delete();
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

    public function Holidays(Request $request)
    {
        $HoliDay = new Holiday();

        $save = $HoliDay->fill($request->all())->save();

        if ($save) {
            return redirect()->back()->with(['saved success' => true]);
        } else {
            return redirect()->back()->with(['not success' => true]);
        }
    }

    public function GetCustomeHolidays()
    {
        $HolidayNumbers = Holiday::whereYear('leaves', Carbon::now()->year)->whereMonth('leaves', Carbon::now()->month)->count();

        dd($HolidayNumbers);
    }

    public function TimeManagement(Request $request)
    {
        try {
            $time = new SetTime();

            if ($time::truncate()) {
                $save = $time->fill($request->all())->save();
                if ($save) {
                    return redirect()->back()->with('success', 'Data saved Successfully....');
                } else {
                    return redirect()->back()->with('unsuccess', 'oops Data are not saved please try again....');
                }
            } else {
                return redirect()->back()->with('failure', 'oops previous data are not deleted please try again later....');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function TrashedUserList()
    {
        $users = User::onlyTrashed()->get();
        return view('TrashedUsers', ['users' => $users]);
    }

    public function RestoreUsers($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user_detail = ExtraUserData::onlyTrashed()->where('user_id', $id)->restore();
        if ($user && $user_detail) {
            $restoring = $user->restore();

            if ($restoring) {
                return redirect()->back()->with('restore', 'User is Restored');
            } else {
                return redirect()->back()->with('not_restore', 'oops something went wrong ,  User or User related data are not Restored');
            }
        }
    }

    public function RemoveUser($id)
    {
        $force_delete = User::onlyTrashed()->find($id);

        if ($force_delete) {
            $delete = $force_delete->forceDelete();
            if ($delete) {
                return redirect()->back()->with('Success', 'User is Deleted Permanantly');
            } else {
                return redirect()->back()->with('error', 'oops something went wrong User can not deleted');
            }
        } else {
            return redirect()->back()->with('error', 'User can not be found , check if this user exists or not');
        }
    }

    public function EmpCheckout()
    {
        $checkout_null_data = EmployeeTimeWatcher::with('user')->where('leave', null)->get();
        // dd($checkout_null_data);
        return view('EmployeeCheckout', ['checkoutdata' => $checkout_null_data]);
    }

    public function EmployeeCheckout(Request $request)
    {
        try {
            $insert_checkout_time = EmployeeTimeWatcher::where('id', $request->id)->update(['leave' => $request->end]);

            if ($insert_checkout_time) {
                return redirect()->back()->with('success_checkout', 'Work Ends Success');
            } else {
                return redirect()->back()->with('error_checkout', 'Oops! Something went wrong, please try again later');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error_checkout', 'Error: ' . $e->getMessage());
        }
    }

    // APIS

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
        $lateEmployees = EmployeeTimeWatcher::whereDate('entry', Carbon::today())->whereTime('entry', '>', SetTime::value('from'))->count();
        $employeeTime = EmployeeTimeWatcher::whereDate('leave', Carbon::today())->count();
        $earlyLeave = EmployeeTimeWatcher::whereDate('leave', Carbon::today())->whereTime('leave', '<', SetTime::value('to'))->count();
        $HolidayNumbers = Holiday::whereYear('leaves', Carbon::now()->year)->whereMonth('leaves', Carbon::now()->month)->count();
        return view('Admin', ['data' => $MergedData, 'userData' => $user, 'leaveToday' => $employeeTime, 'lateEmp' => $lateEmployees, 'presentToday' => $todayAttendance, 'earlyLeave' => $earlyLeave, 'absent' => $user - $todayAttendance, 'HolidayNumbers' => $HolidayNumbers]);
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

    public function APISaveEditEmpDatas(Request $request, $id)
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

    public function APIDeleteEmpDatas($id)
    {
        try {
            if (User::find($id)) {
                $extra_deleteuser = ExtraUserData::where('user_id', $id)->delete();
                $deleteuser = User::find($id)->delete();
                if ($extra_deleteuser && $deleteuser) {
                    return response()->json(['Employee Deleted Successfully']);
                } else {
                    return response()->json(["User is not deleted please try again later..."]);
                }
            } else {
                return response()->json(["User Not Found..."]);
            }
        } catch (Exception $e) {
            Log::info($e);
            return response()->json($e);
        }
    }

    public function APIHolidays(Request $request)
    {
        $HoliDay = new Holiday();

        $save = $HoliDay->fill($request->all())->save();

        if ($save) {
            return response()->json('saved success');
        } else {
            return response()->json('not success');
        }
    }

    public function APITimeManagement(Request $request)
    {
        try {
            $time = new SetTime();

            if ($time::truncate()) {
                $save = $time->fill($request->all())->save();
                if ($save) {
                    return response()->json('Data saved Successfully....');
                } else {
                    return response()->json('oops Data are not saved please try again....');
                }
            } else {
                return response()->json('oops previous data are not deleted please try again later....');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function APITrashedUserList()
    {
        $users = User::onlyTrashed()->get();
        return response()->json(['users' => $users]);
    }

    public function APIRestoreUsers($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user_detail = ExtraUserData::onlyTrashed()->where('user_id', $id)->restore();
        if ($user && $user_detail) {
            $restoring = $user->restore();

            if ($restoring) {
                return response()->json('User is Restored');
            } else {
                return response()->json('oops something went wrong ,  User or User related data are not Restored');
            }
        } else {
            return response()->json('oops something went wrong ,  User or User related data are not Found');
        }
    }

    public function APIRemoveUser($id)
    {
        $force_delete = User::onlyTrashed()->find($id);

        if ($force_delete) {
            $delete = $force_delete->forceDelete();
            if ($delete) {
                return response()->json('User is Deleted Permanantly');
            } else {
                return response()->json('oops something went wrong User can not deleted');
            }
        } else {
            return response()->json('oops something went wrong User can not deleted');
        }
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
            // return redirect()->back()->with('error', 'An error occurred while fetching employee data.');
            return response()->json(['error' => 'An error occurred while fetching employee data.'], 500);
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

    public function NewSystemInstallation()
    {
        $user = User::all()->count();

        if ($user === 1) {
            $userData = new ExtraUserData();
            $userData->user_id = Auth::id();
            $userData->post = "Admin";
            $userData->mobile = "1234567890";
            $userData->address = "Default Address";
            $userData->qualificatio = "Admin";
            $userData->exp = "1 year";
            $userData->joining_date = Carbon::now();
            $userData->isAdmin = 1;


            $user_email = User::latest()->first()->email;
            if ($userData->save()) {
                try {
                    $to = $user_email;
                    $msg = "We are thrilled to welcome you to PurvSoft Tech! Your skills and experience make you a valuable addition to our team, and we're excited to see the contributions you'll bring. At PurvSoft Tech, we foster collaboration, innovation, and growth, and we hope you'll find this journey rewarding.
                                Feel free to explore, ask questions, and connect with your colleagues—we're here to support you every step of the way. Looking forward to achieving great things together!

                                Warm regards,
                                PurvSoft Tech ";
                    $subject = " Welcome to PurvSoft Tech Team ";
                    Mail::to($to)->send(new WelcomeEmail($msg, $subject));
                } catch (Exception $e) {
                    print $e;
                    return response()->json('User data is registered but the email is not sent');
                }
                return redirect()->route('generate.user')->with('registration_success', true);
            } else {
                return redirect()->route('generate.user')->with('unsuccess', true);
            }
        } else {
            return response()->json('  your system is new installed please Signup the new user or System is already configured....');
        }
    }

    public function LeveDataCollection()
    {
        $rejected = Leave::whereMonth('created_at', Carbon::today()->month)->whereYear('created_at', Carbon::today()->year)->where('status', 'Rejected')->get()->sortByDesc('created_at');

        $approves = Leave::whereMonth('created_at', Carbon::today()->month)->whereYear('created_at', Carbon::today()->year)->where('status', 'Approved')->get()->sortByDesc('created_at');

        $pending = Leave::whereMonth('created_at', Carbon::today()->month)->whereYear('created_at', Carbon::today()->year)->where('status', 'pending')->get()->sortByDesc('created_at');

        return view('EmployeeLeaveSection', ['rejection' => $rejected, 'approval' => $approves, 'pending' => $pending]);
    }
}
