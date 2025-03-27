<?php

use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeAttendance;
// use App\Models\ExtraUserData;
use App\Http\Middleware\AdminCheck;




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/attendance/{id}', [EmployeeAttendance::class, 'EmployeeAttendance']);
Route::get('/admin', [AdminController::class, 'hello'])->middleware(AdminCheck::class);
Route::get('/user_details', [AdminController::class, 'AddUserDetails'])->middleware(AdminCheck::class);


Route::get('/add_latest_user', [AdminController::class, 'GetLatestUser']);


Route::post('/Entery', [EmployeeAttendance::class, 'WorkStart']);
Route::post('/leave', [EmployeeAttendance::class, 'WorkEnd']);
Route::post('/user_register', [AdminController::class, 'AddUsers']);
Route::post('/user_details', [AdminController::class, 'AddUserDetails'])->middleware(AdminCheck::class);
Route::post('/get_user_info', [AdminController::class, 'SearchUser']);
// Route::post('/work-start', [AdminController::class, 'WorkStart'])->name('work.start');


Route::view('/homepage', 'EmployeeAttendance');
Route::view('/attendance', 'Attendance');
