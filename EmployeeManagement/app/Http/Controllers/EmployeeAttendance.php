<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeWatcher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class EmployeeAttendance extends Controller
{
    public function WorkStart(Request $request)
    {
        $user = Auth::user();
        $Entry = new EmployeeTimeWatcher();
        $Entry->entry = $request->start;
        $Entry->user_id = $user->id;

        if ($Entry->save()) {
            return response()->json(["message" => "Employee Started Working"]);
            // return view('EmployeeTakenLeave', ['work_start' => "Employee Started Working"]);
        }
    }


    public function WorkEnd(Request $request)
    {
        $user = Auth::user();

        $gettingLeaveRow = EmployeeTimeWatcher::where('user_id', $user->id)->whereNull('leave')->latest()->first();

        if ($gettingLeaveRow) {
            $gettingLeaveRow->leave = $request->end;

            if ($gettingLeaveRow->save()) {
                return response()->json(["message" => "Employee has taken a Leave"]);
                // return view('EmployeeAttendance', ['work_end' => "Employees has taken a Leave..."]);
            }
        }

        return response()->json($request->all());
    }


    public function EmployeeAttendance($id)
    {
        $getattendance = EmployeeTimeWatcher::where('user_id', $id)->get();

        $attendance = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('entry', Carbon::now()->month)->whereYear('entry', Carbon::now()->year)->count();

        $lateattendance = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->where('entry', '>', '10:10')->count();

        $absent = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->where()->count();

        return view('Attendance', ['data' => $getattendance, 'attendance' => $attendance, 'lateattendance' => $lateattendance]);
    }
}
