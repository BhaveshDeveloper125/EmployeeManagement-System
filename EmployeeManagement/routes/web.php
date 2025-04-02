<?php

use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeAttendance;
use App\Http\Controllers\MediaController;
use App\Http\Middleware\AddUserDetailsCheck;
// use App\Models\ExtraUserData;
use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\LoginCheck;
use App\Models\EmployeeTimeWatcher;
use App\Models\ExtraUserData;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(LoginCheck::class);
Route::get('/attendance/{id}', [EmployeeAttendance::class, 'EmployeeAttendance'])->middleware(LoginCheck::class);
Route::get('/adminPanel', [AdminController::class, 'hello'])->middleware(AdminCheck::class);
Route::get('/user_details', [AdminController::class, 'AddUserDetails'])->middleware(LoginCheck::class);
Route::get('/editemp', [AdminController::class, 'EditEmpData'])->middleware(LoginCheck::class);
Route::get('/editemps/{id}', [AdminController::class, 'EditEmpDatas'])->middleware(LoginCheck::class);
// Route::get('/pdfdatas', [MediaController::class, 'PDFGenerator'])->middleware(LoginCheck::class);
Route::get('/add_latest_user', [AdminController::class, 'GetLatestUser'])->middleware(LoginCheck::class);
Route::get('/homepage', function () {
    $user = EmployeeTimeWatcher::where('user_id', auth::user()->id)->whereDate('leave', Carbon\Carbon::today())->get();
    return view('EmployeeAttendance', ['user' => $user]);
});


// Route::post('/ipaddress', function (\Illuminate\Http\Request $request) {
//     // 150.129.206.0
//     $apiData = Http::get('https://api.ipify.org/?format=json');
//     $jsonapi = $apiData->json();
//     $api = $jsonapi['ip'];


//     $officeip = $api;
//     if ($request->ip == $officeip) {
//         return view('home');
//     } else {
//         return response()->json("IP is not Matching  , UserIP : $request->ip OffceIP : $officeip");
//     }
// })->middleware(LoginCheck::class);



Route::post('/Entery', [EmployeeAttendance::class, 'WorkStart'])->middleware(LoginCheck::class);
Route::post('/leave', [EmployeeAttendance::class, 'WorkEnd'])->middleware(LoginCheck::class);
Route::post('/user_register', [AdminController::class, 'AddUsers'])->middleware(LoginCheck::class);
Route::post('/user_details', [AdminController::class, 'AddUserDetails'])->middleware(LoginCheck::class);
Route::post('/get_user_info', [AdminController::class, 'SearchUser'])->middleware(LoginCheck::class);
Route::put('/editedData/{id}', [AdminController::class, 'SaveEditEmpDatas'])->middleware(LoginCheck::class);


// Route::view('/homepage', 'EmployeeAttendance')->middleware(LoginCheck::class);
Route::view('/attendance', 'Attendance')->middleware(LoginCheck::class);




Route::prefix('/adminPanel')->group(function () {
    Route::get('/records', [AdminController::class, 'getData']);
    Route::view('/generate_user', 'GenerateUser');
    Route::get('/downloadData', [MediaController::class, 'PDFGenerator']);
    Route::view('/search_user', 'SearchEmployee');
});
