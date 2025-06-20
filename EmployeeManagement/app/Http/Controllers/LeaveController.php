<?php

namespace App\Http\Controllers;

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

            $save = Leave::create($validation);

            if ($save) {
                return redirect()->back()->with(['leave_send' => 'Your leave request has been submitted successfully! please wait for the response']);
            } else {
                return redirect()->back()->with(['leave_not_send' => 'oops something went wrong! please try again later']);
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

        return view('EmpLeaveSection', ['list' => $list]);
    }

    public function Approve($id)
    {
        $GetLeave = Leave::where('id', $id)->update(['status' => 'Approved']);

        if ($GetLeave) {
            return redirect()->back()->with(['Approved' => true]);
        } else {
            dd('Not approved');
        }
    }

    public function Reject($id)
    {
        $RejectLeave = Leave::where('id', $id)->update(['status' => 'Rejected']);

        if ($RejectLeave) {
            dd('Rejected');
        } else {
            dd('Not Rejected');
        }
    }

    public function MarkAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
