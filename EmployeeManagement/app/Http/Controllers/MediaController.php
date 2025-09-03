<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeWatcher;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Command\ListCommand\FunctionEnumerator;

class MediaController extends Controller
{
    public function PDFGenerator()
    {
        $data = EmployeeTimeWatcher::join('extra_user_data', 'employee_time_watchers.user_id', '=', 'extra_user_data.user_id')
            ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
            ->select(
                'employee_time_watchers.user_id',
                'employee_time_watchers.entry',
                'employee_time_watchers.leave',
                'extra_user_data.post',
                'extra_user_data.mobile',
                'extra_user_data.address',
                'extra_user_data.qualificatio',
                'users.name',
            )
            ->get();
        return view('Download', ['data' => $data]);
    }

    public function FilterDataDateWise(Request $request)
    {
        try {
            $validation = $request->validate([
                'from' => 'required|date',
                'to' => 'required|date'
            ]);

            $FilterData = User::with(['extraUserData', 'employeTimeWatcher'])
                ->whereHas('employeTimeWatcher', function ($query) use ($validation) {
                    $query->whereBetween('entry', [$validation['from'], $validation['to']]);
                })
                ->get();
            return redirect()->back()->with('FilterData', $FilterData);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function FilterDataNameWise(Request $request)
    {
        try {
            $validation = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $FilterName = User::with(['extraUserData', 'employeTimeWatcher'])
                ->where('name', 'LIKE', '%' . $validation['name'] . '%')
                ->get();

            return redirect()->back()->with('FilterName', $FilterName);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function apiPDFGenerator()
    {
        $data = EmployeeTimeWatcher::join('extra_user_data', 'employee_time_watchers.user_id', '=', 'extra_user_data.user_id')
            ->join('users', 'employee_time_watchers.user_id', '=', 'users.id')
            ->select(
                'employee_time_watchers.user_id',
                'employee_time_watchers.entry',
                'employee_time_watchers.leave',
                'extra_user_data.post',
                'extra_user_data.mobile',
                'extra_user_data.address',
                'extra_user_data.qualificatio',
                'users.name',
            )
            ->get();
        return response()->json(['data' => $data]);
    }
}
