<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeWatcher;
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
                    ->whereDate('entry', '>', '10:00:00')
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


            default:
                return redirect()->back()->with(['message' => 'oops something went wrong...']);
        }
    }
}
