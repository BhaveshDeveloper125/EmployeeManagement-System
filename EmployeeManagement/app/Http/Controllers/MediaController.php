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
        return view('PDFRecords', ['data' => $data]);
    }
}
