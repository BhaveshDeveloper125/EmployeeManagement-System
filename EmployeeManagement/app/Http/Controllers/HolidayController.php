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
            'satur => false'
        ];
        WeeklyHolidays::firstOrNew([])->fill($updatedata)->save();
        dd($WeeklyHoliday);
        return response()->json($request->all());
    }
}
