<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeWatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MediaController extends Controller
{
    public function PDFGenerator()
    {
        $data = DB::table('combined_user_data')->get();
        return view('Download', ['data' => $data]);
    }

    public function apiPDFGenerator()
    {
        $data = DB::table('combined_user_data')->get();
        return response()->json(['data' => $data]);
    }
}
