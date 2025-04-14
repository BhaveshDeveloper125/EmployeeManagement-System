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
                $late = EmployeeTimeWatcher::where('entry', '>', Carbon::today()->setTime(10, 0, 0))->get();
                // return response()->json(['message' => ]);
                // dd($late);
                return view('Filter', ['late' => $late]);

            case 'employeelist':
                $emplist = User::all();
                // return response()->json(['message' => ]);
                // dd($emplist);
                return view('Filter', ['emplist' => $emplist]);

            case 'present':
                $present = EmployeeTimeWatcher::whereDate('entry', Carbon::today())->get();
                // return response()->json(['message' => ]);
                // dd($present);
                return view('Filter', ['present' => $present]);

            default:
                return redirect()->back()->with(['message' => 'oops something went wrong...']);
        }
    }
}
