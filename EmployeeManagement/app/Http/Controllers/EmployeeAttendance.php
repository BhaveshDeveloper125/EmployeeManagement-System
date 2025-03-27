<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeWatcher;
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
            return view('EmployeeTakenLeave', ['work_start' => "Employee Started Working"]);
        }
    }


    public function WorkEnd(Request $request)
    {
        $user = Auth::user();

        $gettingLeaveRow = EmployeeTimeWatcher::where('user_id', $user->id)->whereNull('leave')->latest()->first();

        if ($gettingLeaveRow) {
            $gettingLeaveRow->leave = $request->end;

            if ($gettingLeaveRow->save()) {
                return view('EmployeeAttendance', ['work_end' => "Employees has taken a Leave..."]);
            }
        }

        return response()->json($request->all());
    }


    public function EmployeeAttendance($id)
    {
        $getattendance = EmployeeTimeWatcher::where('user_id', $id)->get();
        return view('Attendance', ['data' => $getattendance]);
    }
}
