<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeWatcher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;
use App\Models\UserWifiData;

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
            return redirect()->back()->with('Message', 'Employee Started Working');
        }
    }


    public function WorkEnd(Request $request)
    {
        $user = Auth::user();

        $gettingLeaveRow = EmployeeTimeWatcher::where('user_id', $user->id)->whereNull('leave')->latest()->first();

        if ($gettingLeaveRow) {
            $gettingLeaveRow->leave = $request->end;

            if ($gettingLeaveRow->save()) {
                return redirect()->back()->with('Message', 'Employee has taken a leave');
            }
        }

        return response()->json($request->all());
    }


    public function EmployeeAttendance($id)
    {
        $getattendance = EmployeeTimeWatcher::where('user_id', $id)->get();

        $attendance = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('entry', Carbon::now()->month)->whereYear('entry', Carbon::now()->year)->count();

        $lateattendance = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('entry', Carbon::now()->month)->where('entry', '>', '10:10')->count();

        $currentMonthTotalDays = Carbon::now()->daysInMonth();

        $absent = $currentMonthTotalDays - $attendance;

        $earlyLeave = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', Carbon::now()->month)->where('leave', '<', Carbon::createFromTime(19, 0, 0))->count();

        $overtime = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', '>', Carbon::createFromTime(19, 15, 0))->count();


        $leavingtime = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', '<', Carbon::createFromTime(19, 15, 0))->count();

        return view('Attendance', ['data' => $getattendance, 'attendance' => $attendance, 'lateattendance' => $lateattendance, 'earlyLeave' => $earlyLeave, 'absent' => $absent, 'overtime' => $overtime, 'leavingtime' => $leavingtime]);
    }

    public function APIEmployeeAttendance($id)
    {
        $getattendance = EmployeeTimeWatcher::where('user_id', $id)->get();

        $attendance = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('entry', Carbon::now()->month)->whereYear('entry', Carbon::now()->year)->count();

        $lateattendance = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('entry', Carbon::now()->month)->where('entry', '>', '10:10')->count();

        $currentMonthTotalDays = Carbon::now()->daysInMonth();

        $absent = $currentMonthTotalDays - $attendance;

        $earlyLeave = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', Carbon::now()->month)->where('leave', '<', Carbon::createFromTime(19, 0, 0))->count();

        $overtime = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', '>', Carbon::createFromTime(19, 15, 0))->count();


        $leavingtime = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', '<', Carbon::createFromTime(19, 15, 0))->count();

        return response()->json(['data' => $getattendance, 'attendance' => $attendance, 'lateattendance' => $lateattendance, 'earlyLeave' => $earlyLeave, 'absent' => $absent, 'overtime' => $overtime, 'leavingtime' => $leavingtime]);
    }


    public function homepage($id)
    {
        $getattendance = EmployeeTimeWatcher::where('user_id', $id)->get();

        $attendance = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('entry', Carbon::now()->month)->whereYear('entry', Carbon::now()->year)->count();

        $lateattendance = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('entry', Carbon::now()->month)->where('entry', '>', '10:10')->count();

        $currentMonthTotalDays = Carbon::now()->daysInMonth();

        $absent = $currentMonthTotalDays - $attendance;

        $earlyLeave = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', Carbon::now()->month)->where('leave', '<', Carbon::createFromTime(19, 0, 0))->count();

        $overtime = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', '>', Carbon::createFromTime(19, 15, 0))->count();


        $leavingtime = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', '<', Carbon::createFromTime(19, 15, 0))->count();

        $today = Carbon::today()->toDateString();

        $timeEntry = EmployeeTimeWatcher::where('user_id', Auth::user()->id)
            ->whereDate('entry', $today)
            ->first();

        return view('EmployeeAttendance', [
            'data' => $getattendance,
            'attendance' => $attendance,
            'lateattendance' => $lateattendance,
            'earlyLeave' => $earlyLeave,
            'absent' => $absent,
            'overtime' => $overtime,
            'leavingtime' => $leavingtime,
            'hasCheckedIn' => !is_null($timeEntry),
            'hasCheckedOut' => !is_null($timeEntry) && !is_null($timeEntry->leave),
        ]);
    }

    public function APILogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'You are loggedout Successfully...']);
        // return response()->json([$request->all()]);
    }

    public function APILoggedUserData()
    {
        $userData = Auth::user();
        return response()->json(["Current Logged In User Data" => $userData]);
    }


    public function IPDatas(Request $request)
    {
        $output = [];
        exec('ipconfig /all', $output);
        exec('netsh wlan show interfaces ', $output);

        exec('ifconfig', $output);
        $data = implode("\n", $output);
        return response()->json([$data]);
    }

    public function Location()
    {
        $ip = Http::get('https://api.ipify.org/');

        if ($ip->successful()) {
            $currentlocationInfo = Location::get($ip);

            return response()->json([compact('currentlocationInfo')]);
        }
    }

    public function AddWifiData(Request $request)
    {
        $wifi = new UserWifiData();
        $wifi->wifiName = $request->wifiName;
        $wifi->BSSID = $request->BSSID;
        $wifi->ipv4 = $request->ipv4;
        $wifi->ipv6 = $request->ipv6;
        $wifi->broadcast = $request->broadcast;
        $wifi->gateway = $request->gateway;
        $wifi->submask = $request->submask;

        if ($wifi->save()) {
            return response()->json(["Message: Data saved successfully"]);
        } else {
            return response()->json(["Message: oops something went wrong  Data is not saved..."]);
        }
    }

    public function getMacaddress(Request $request)
    {
        $ipaddress = $request->ip;
        $arp = `arp -a $ipaddress`;
        $lines = explode("\n", $arp);

        foreach ($lines as $i) {
            if (strpos($i, $ipaddress)) {
                $parts = preg_split('/\s+/', trim($i));
                return $parts[1] ?? 'MAC NOT FOUND';
            }
        }
        return 'MAC NOT FOUND';
    }

    public function AddNetwork(Request $request)
    {
        // 
    }

    public function GetNetworkData()
    {
        $data =  UserWifiData::all();

        return response()->json([$data]);
    }
}
