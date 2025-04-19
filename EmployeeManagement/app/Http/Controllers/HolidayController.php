<?php

namespace App\Http\Controllers;

use App\Models\WeeklyHolidays;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function SetWeeklyHoliday(Request $request)
    {
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
        $setdefault_first = WeeklyHolidays::firstOrNew([])->fill($updatedata)->save();
        if ($setdefault_first) {
            dd($request->all());
        }
        return response()->json($request->all());
    }
}
