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
use Illuminate\Support\Facades\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/attendance/{id}', [EmployeeAttendance::class, 'EmployeeAttendance']);
Route::get('/admin', [AdminController::class, 'hello'])->middleware(AdminCheck::class);
Route::get('/user_details', [AdminController::class, 'AddUserDetails']);
Route::get('/editemp', [AdminController::class, 'EditEmpData']);
Route::get('/editemps/{id}', [AdminController::class, 'EditEmpDatas']);
Route::get('/pdfdatas', [MediaController::class, 'PDFGenerator']);
Route::get('/add_latest_user', [AdminController::class, 'GetLatestUser']);


Route::get('/ipaddress', function () {
    $ipAddress = Request::ip();

    return response()->json("IP : $ipAddress");
});



Route::post('/Entery', [EmployeeAttendance::class, 'WorkStart']);
Route::post('/leave', [EmployeeAttendance::class, 'WorkEnd']);
Route::post('/user_register', [AdminController::class, 'AddUsers']);
Route::post('/user_details', [AdminController::class, 'AddUserDetails']);
Route::post('/get_user_info', [AdminController::class, 'SearchUser']);
Route::post('/editedData', [AdminController::class, 'SaveEditEmpDatas']);


Route::view('/homepage', 'EmployeeAttendance');
Route::view('/attendance', 'Attendance');
