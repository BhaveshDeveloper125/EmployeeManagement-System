<?php

namespace App\Http\Controllers;

use App\Models\ExtraUserData;
use App\Models\Leave;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class LeaveController extends Controller
{
    public function GetLeaves(Request $request)
    {

        try {

            $validation = $request->validate([
                'name' => 'required|string|max:255',
                'user_id' => 'required|numeric',
                'department' => 'required|string|max:255',
                'type' => 'required|string|in:medical_leave,casual_leave',
                'from' => 'required|date',
                'to' => 'required|date|after_or_equal:from',
                'duration' => 'required|in:half_day,full_day',
                'reason' => 'required',
            ]);

            $availabel_leave = ExtraUserData::where('user_id', $validation['user_id'])->value('leaves');
            $diff = Carbon::parse($validation['from'])->diffInDays($validation['to']);


            switch ($availabel_leave) {
                case $availabel_leave == null:
                    return redirect()->back()->with(['leave_not_send' => 'please contact the HR/Manager you dont have a leaves']);
                    // break;
                case $diff > $availabel_leave && $validation['type'] == "casual_leave":
                    return redirect()->back()->with(['leave_not_send' => ' You dont have Leaves left that much leave...']);
                    // break;
                case $diff < $availabel_leave:
                    $save = Leave::create($validation);

                    if ($save) {
                        return redirect()->back()->with(['leave_send' => ' Leave Request is sent! Please wait for the Response...']);
                    } else {
                        return redirect()->back()->with(['leave_not_send' => ' You dont have Leaves left that much leave...']);
                    }


                    // break;
                default:
                    return redirect()->back()->with(['leave_not_send' => 'oops something went wrong! please try again later']);
                    // break;
            }
        } catch (Exception $e) {
            Log::info("Error While Requesting Leave : $e");
        }
    }

    public function EmpLeaveList()
    {
        $list = Leave::where('user_id', Auth::id())
            ->whereMonth('created_at', Carbon::today()->month)
            ->whereYear('created_at', Carbon::today()->year)
            ->orderByDesc('created_at')
            ->get();

        $leaveCount = ExtraUserData::where('user_id', Auth::id())->value('leaves');

        $pending = Leave::where('user_id', Auth::id())->where('status', 'pending')->count();
        $approved = Leave::where('user_id', Auth::id())->where('status', 'Approved')->count();
        $reject = Leave::where('user_id', Auth::id())->where('status', 'Rejected')->count();
        $remaining = ExtraUserData::where('user_id', Auth::id())->value('leaves');

        return view('EmpLeaveSection', ['list' => $list, 'pending' => $pending, 'approved' => $approved, 'reject' => $reject, 'remaining' => $remaining]);
    }

    public function Approve($id)
    {
        $emp_leave_request = Leave::find($id);

        $availabel_leave = ExtraUserData::where('user_id', $emp_leave_request->user_id)->value('leaves');
        $leave = $availabel_leave - Carbon::parse($emp_leave_request->from)->diffInDays($emp_leave_request->to);
        $leaveAsString = strval($leave);

        $GetLeave = Leave::where('id', $id)->update(['status' => 'Approved']);

        if ($GetLeave) {
            ExtraUserData::where('user_id', $emp_leave_request->user_id)->update([
                'leaves' => $leaveAsString
            ]);
            return redirect()->back()->with(['Approved' => true]);
        } else {
            return redirect()->back()->with(['Not Approved' => true]);
        }
    }

    public function Reject($id)
    {
        $RejectLeave = Leave::where('id', $id)->update(['status' => 'Rejected']);

        if ($RejectLeave) {
            return redirect()->back()->with(['Rejected' => true]);
        } else {
            return redirect()->back()->with(['Not Rejected' => true]);
        }
    }

    public function MarkAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    // APIS

    public function APIGetLeaves(Request $request)
    {

        try {
            $validation = $request->validate([
                'name' => 'required|string|max:255',
                'user_id' => 'required|numeric',
                'department' => 'required|string|max:255',
                'type' => 'required|string|in:medical_leave,casual_leave',
                'from' => 'required|date',
                'to' => 'required|date|after_or_equal:from',
                'duration' => 'required|in:half_day,full_day',
                'reason' => 'required',
            ]);

            $availabel_leave = ExtraUserData::where('user_id', $validation['user_id'])->value('leaves');
            $diff = Carbon::parse($validation['from'])->diffInDays($validation['to']);


            switch ($availabel_leave) {
                case $availabel_leave == null:
                    return response()->json(['leave_not_send' => 'please contact the HR/Manager you dont have a leaves']);
                case $diff > $availabel_leave && $validation['type'] == "casual_leave":
                    return response()->json(['leave_not_send' => ' You dont have Leaves left that much leave...']);
                case $diff < $availabel_leave:
                    $save = Leave::create($validation);

                    if ($save) {
                        return response()->json(['leave_send' => ' Leave Request is sent! Please wait for the Response...']);
                    } else {
                        return response()->json(['leave_not_send' => 'You dont have Leaves left that much leave...']);
                    }
                default:
                    return response()->json(['leave_not_send' => 'oops something went wrong! please try again later'], 500);
            }
        } catch (Exception $e) {
            Log::info("Error While Requesting Leave : $e");
        }
    }

    public function APIEmpLeaveList()
    {
        $list = Leave::where('user_id', Auth::id())
            ->whereMonth('created_at', Carbon::today()->month)
            ->whereYear('created_at', Carbon::today()->year)
            ->orderByDesc('created_at')
            ->get();

        $leaveCount = ExtraUserData::where('user_id', Auth::id())->value('leaves');

        $pending = Leave::where('user_id', Auth::id())->where('status', 'pending')->count();
        $approved = Leave::where('user_id', Auth::id())->where('status', 'Approved')->count();
        $reject = Leave::where('user_id', Auth::id())->where('status', 'reject')->count();
        $remaining = ExtraUserData::where('user_id', Auth::id())->value('leaves');

        return response()->json(['list' => $list, 'pending' => $pending, 'approved' => $approved, 'reject' => $reject, 'remaining' => $remaining]);
    }

    public function APIApprove($id)
    {
        $emp_leave_request = Leave::find($id);

        $availabel_leave = ExtraUserData::where('user_id', $emp_leave_request->user_id)->value('leaves');
        $leave = $availabel_leave - Carbon::parse($emp_leave_request->from)->diffInDays($emp_leave_request->to);
        $leaveAsString = strval($leave);

        $GetLeave = Leave::where('id', $id)->update(['status' => 'Approved']);

        if ($GetLeave) {
            ExtraUserData::where('user_id', $emp_leave_request->user_id)->update([
                'leaves' => $leaveAsString
            ]);
            return response()->json(['Approved' => true]);
        } else {
            return response()->json(['Not Approved' => true]);
        }
    }

    public function APIReject($id)
    {
        $RejectLeave = Leave::where('id', $id)->update(['status' => 'Rejected']);

        if ($RejectLeave) {
            return response()->json(['Rejected' => true]);
        } else {
            return response()->json(['Not Rejected' => true]);
        }
    }
}
