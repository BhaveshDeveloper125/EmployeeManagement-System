<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeWatcher;
use App\Models\Holiday;
use App\Models\SetTime;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function FilterData(Request $request)
    {
        switch ($request->filters) {
            case 'late':
                $late = EmployeeTimeWatcher::whereDate('entry', Carbon::today())
                    ->whereTime('entry', '>', SetTime::value('from'))
                    ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
                    ->select('employee_time_watchers.*', 'users.name')
                    ->get();
                return view('Filter', ['late' => $late]);

            case 'employeelist':
                $emplist = User::all();
                return view('Filter', ['emplist' => $emplist]);

            case 'present':
                $present = EmployeeTimeWatcher::whereDate('entry', Carbon::today())->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
                    ->select('employee_time_watchers.*', 'users.name')
                    ->get();;
                return view('Filter', ['present' => $present]);

            case 'leave':
                $leave = EmployeeTimeWatcher::whereDate('entry', Carbon::today())
                    ->whereDate('entry', '>', '10:00:00')
                    ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
                    ->select('employee_time_watchers.*', 'users.name')
                    ->get();
                return view('Filter', ['leave' => $leave]);

            case 'early_leave':
                $early_leave = EmployeeTimeWatcher::whereDate('entry', Carbon::today())
                    ->whereTime('leave', '<', '19:00:00')
                    ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
                    ->select('employee_time_watchers.*', 'users.name')
                    ->get();

                return view('Filter', ['early_leave' => $early_leave]);

            case 'absent':
                $absent = User::leftJoin('employee_time_watchers', function ($join) {
                    $join->on('users.id', '=', 'employee_time_watchers.user_id')
                        ->whereDate('employee_time_watchers.entry', Carbon::today());
                })
                    ->leftJoin('extra_user_data', 'users.id', '=', 'extra_user_data.user_id') // Joining extra_user_data
                    ->whereNull('employee_time_watchers.id')
                    ->select('users.name', 'users.email', 'extra_user_data.mobile') // Fetch email & mobile
                    ->get();

                return view('Filter', ['absent' => $absent]);


            case 'custome_holiday':
                $CustomeHoliday = Holiday::whereYear('leaves', Carbon::now()->year)->whereMonth('leaves', Carbon::now()->month)->get();
                return view('Filter', ['CustomeHoliday' => $CustomeHoliday]);


            default:
                return redirect()->back()->with(['message' => 'oops something went wrong...']);
        }
    }

    public function apiFilterData($id)
    {
        switch ($id) {
            case 'late':
                $late = EmployeeTimeWatcher::whereDate('entry', Carbon::today())
                    ->whereDate('entry', '>', '10:00:00')
                    ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
                    ->select('employee_time_watchers.*', 'users.name')
                    ->get();
                return response()->json([$late]);

            case 'employeelist':
                $emplist = User::all();
                return response()->json([$emplist]);

            case 'present':
                $present = EmployeeTimeWatcher::whereDate('entry', Carbon::today())->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
                    ->select('employee_time_watchers.*', 'users.name')
                    ->get();;
                return response()->json([$present]);

            case 'leave':
                $leave = EmployeeTimeWatcher::whereDate('entry', Carbon::today())
                    ->whereDate('entry', '>', '10:00:00')
                    ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
                    ->select('employee_time_watchers.*', 'users.name')
                    ->get();
                return response()->json(['leave' => $leave]);

            case 'early_leave':
                $early_leave = EmployeeTimeWatcher::whereDate('entry', Carbon::today())
                    ->whereTime('leave', '<', '19:00:00')
                    ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
                    ->select('employee_time_watchers.*', 'users.name')
                    ->get();

                return response()->json([$early_leave]);

            case 'absent':
                $absent = User::leftJoin('employee_time_watchers', function ($join) {
                    $join->on('users.id', '=', 'employee_time_watchers.user_id')
                        ->whereDate('employee_time_watchers.entry', Carbon::today());
                })
                    ->leftJoin('extra_user_data', 'users.id', '=', 'extra_user_data.user_id') // Joining extra_user_data
                    ->whereNull('employee_time_watchers.id')
                    ->select('users.name', 'users.email', 'extra_user_data.mobile') // Fetch email & mobile
                    ->get();

                return response()->json(['absent' => $absent]);


            case 'custome_holiday':
                $CustomeHoliday = Holiday::whereYear('leaves', Carbon::now()->year)->whereMonth('leaves', Carbon::now()->month)->get();
                return response()->json(['CustomeHoliday' => $CustomeHoliday]);

            default:
                return response()->json(['message' => 'oops something went wrong...']);
        }
    }
}
