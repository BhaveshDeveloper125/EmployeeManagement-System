<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeWatcher;
use App\Models\ExtraUserData;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;
use App\Models\UserWifiData;
use App\Models\WeeklyHolidays;

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

        $count =  -EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', Carbon::today()->month)->count();

        $leavingtime = Carbon::today()->subDays($count);

        // $leavingtime = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', '<', Carbon::createFromTime(19, 15, 0))->count();

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
        $isadmin = ExtraUserData::where('user_id', $id)->where('isAdmin', '1')->value('isAdmin');


        if ($isadmin == '1') {
            return redirect('adminPanel');
        }





        $holidayDays = [];
        $weeklyHolidays = WeeklyHolidays::first();

        $dayMap = [
            'mon' => 'mon',
            'tue' => 'tue',
            'wed' => 'wed',
            'thurs' => 'thu',
            'fri' => 'fri',
            'satur' => 'sat',
            'sun' => 'sun'
        ];

        if ($weeklyHolidays) {
            foreach ($dayMap as $dbDay => $carbonDay) {
                if ($weeklyHolidays->$dbDay) {
                    $holidayDays[] = $carbonDay;
                }
            }
        }

        $totalWorkingDays_for_loop_only = Carbon::now()->daysInMonth();
        $totalWorkingDays = $totalWorkingDays_for_loop_only;

        for ($i = 1; $i <= $totalWorkingDays_for_loop_only; $i++) {
            $today = Carbon::now()->startOfMonth()->addDays($i - 1);
            $day_name = strtolower(substr($today->format('D'), 0, 3));

            if (in_array($day_name, $holidayDays)) {
                $totalWorkingDays--;
            }
        }

        $today = Carbon::now()->startOfMonth()->diffInDays(Carbon::now()->startOfDay());
        $untill_today = $today;

        for ($i = 1; $i <= $untill_today; $i++) {
            $today = Carbon::now()->startOfMonth()->addDays($i - 1);
            $day_name = strtolower(substr($today->format('D'), 0, 3));
            if (in_array($day_name, $holidayDays)) {
                $untill_today--;
            }
        }

        $actual_working_days = $totalWorkingDays - $untill_today;















        $join_date = ExtraUserData::where('user_id', Auth::id())->value('joining_date');
        $current_month = Carbon::parse($join_date)->month;

        if ($current_month == Carbon::today()->month) {
            $current_working_day = EmployeeTimeWatcher::where('user_id', Auth::id())->whereYear('entry', Carbon::today()->year)->whereMonth('entry', Carbon::today()->month)->count();

            $current_date = Carbon::now()->format('y-m-d');
            $PresentWorkingDays = Carbon::parse($join_date)->diffInDays($current_date);

            $Extractable_holiday_from_weekend = 0;

            for ($i = 0; $i <= $PresentWorkingDays; $i++) {
                $day =  Carbon::parse($join_date)->copy()->addDays($i);
                $dayName = $dayName = strtolower($day->format('D'));
                // echo $day->format('D') . "<br><br>";
                if (in_array($dayName, $holidayDays)) {
                    $Extractable_holiday_from_weekend++;
                }
            }

            $CurrentWorkabledDays =  ($PresentWorkingDays + 1) - $Extractable_holiday_from_weekend;

            $absent_days = $CurrentWorkabledDays - $current_working_day;
        } else {

            $current_worked_day = EmployeeTimeWatcher::where('user_id', Auth::id())->whereYear('entry', Carbon::today()->year)->whereMonth('entry', Carbon::today()->month)->count();

            $StartOfMonth = Carbon::now()->startOfMonth();
            $current_date = Carbon::now()->startOfDay();

            $PresentWorkingDays = (int) $StartOfMonth->diffInDays($current_date);


            $Extractable_holiday_from_weekend = 0;

            for ($i = 0; $i <= $PresentWorkingDays; $i++) {
                $day = $StartOfMonth->copy()->addDays($i);
                $dayName = $dayName = strtolower($day->format('D'));
                if (in_array($dayName, $holidayDays)) {
                    $Extractable_holiday_from_weekend++;
                }
            }

            $CurrentWorkabledDays =  ($PresentWorkingDays + 1) - $Extractable_holiday_from_weekend;
            $absent_days = $CurrentWorkabledDays - $current_worked_day;
        }




























        $getattendance = EmployeeTimeWatcher::where('user_id', $id)->get();

        $attendance = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('entry', Carbon::now()->month)->whereYear('entry', Carbon::now()->year)->count();

        $lateattendance = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('entry', Carbon::now()->month)->where('entry', '>', '10:40')->count();

        $currentMonthTotalDays = Carbon::now()->daysInMonth();

        $absent = $currentMonthTotalDays - $attendance;

        $earlyLeave = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', Carbon::now()->month)->where('leave', '<', Carbon::createFromTime(19, 25, 0))->count();

        $overtime = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', '>', Carbon::createFromTime(19, 45, 0))->count();

        // $leavingtime = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', '<', Carbon::createFromTime(19, 15, 0))->count();

        $currentmonth = Carbon::today()->day;

        $presetnemp = EmployeeTimeWatcher::where('user_id', Auth::user()->id)->whereMonth('leave', Carbon::today()->month)->count();

        $leavingtime = null;

        $userjoiningDate = ExtraUserData::where('user_id', Auth::id())->value('joining_date');
        if ($userjoiningDate) {
            $parseduserjoiningDate = Carbon::parse($userjoiningDate);

            if ($parseduserjoiningDate->isCurrentMonth()) {
                $day_gap = $parseduserjoiningDate->diffInDays(Carbon::now());
                $user_absent = (int) floor($day_gap);
                // dd($user_absent);
                $leavingtime = $user_absent;
            }
        } else {
            $leavingtime = $currentmonth - $presetnemp;
        }

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
            'totalWorkingDays' => $totalWorkingDays,
            'actual_working_days' => $actual_working_days,
            'overtime' => $overtime,
            'leavingtime' => $absent_days,
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
        $userData = User::where('id', Auth::id())->get();
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
        $wifi->wifi_name = $request->wifi_name;
        $wifi->ip = $request->ip;
        $wifi->ssid = $request->ssid;
        $wifi->gateway = $request->gateway;

        if ($wifi->save()) {
            return response()->json(["Success: Data saved successfully"]);
        } else {
            return response()->json(["Message: oops something went wrong  Data is not saved..."]);
        }
    }

    public function GetNetworkData()
    {
        $data =  UserWifiData::all();

        return response()->json([$data]);
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
}
