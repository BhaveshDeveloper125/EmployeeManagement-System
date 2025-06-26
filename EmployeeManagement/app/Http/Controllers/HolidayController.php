<?php

namespace App\Http\Controllers;

use App\Models\WeeklyHolidays;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function SetWeeklyHoliday(Request $request)
    {
        try {
            $WeeklyHoliday = new WeeklyHolidays();
            $updatedata = [
                'sun' => false,
                'mon' => false,
                'tue' => false,
                'wed' => false,
                'thurs' => false,
                'fri' => false,
                'satur' => false,
            ];
            $setholiday = $request->input('weekly_holiday', []);
            foreach ($setholiday as $i) {
                if (array_key_exists($i, $updatedata)) {
                    $updatedata[$i] = true;
                }
            }
            $setdefault_first = WeeklyHolidays::firstOrNew([])->fill($updatedata)->save();
            if ($setdefault_first) {
                return redirect()->back()->with('success', 'Weekly Holiday set');
            }
            return response()->json($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function APISetWeeklyHoliday(Request $request)
    {
        try {
            $WeeklyHoliday = new WeeklyHolidays();
            $updatedata = [
                'sun' => false,
                'mon' => false,
                'tue' => false,
                'wed' => false,
                'thurs' => false,
                'fri' => false,
                'satur' => false,
            ];
            $setholiday = $request->input('weekly_holiday', []);
            foreach ($setholiday as $i) {
                if (array_key_exists($i, $updatedata)) {
                    $updatedata[$i] = true;
                }
            }
            $setdefault_first = WeeklyHolidays::firstOrNew([])->fill($updatedata)->save();
            if ($setdefault_first) {
                return response()->json(['Weekly Holiday set']);
            }
            return response()->json($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
