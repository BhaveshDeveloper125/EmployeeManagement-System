<?php

use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeAttendance;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\MediaController;
use App\Http\Middleware\AddUserDetailsCheck;
// use App\Models\ExtraUserData;
use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\LoginCheck;
use App\Models\EmployeeTimeWatcher;
use App\Models\ExtraUserData;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;


Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(LoginCheck::class);
Route::get('/attendance/{id}', [EmployeeAttendance::class, 'EmployeeAttendance'])->middleware(LoginCheck::class);
Route::get('/adminPanel', [AdminController::class, 'hello'])->middleware(AdminCheck::class);
Route::get('/user_details', [AdminController::class, 'AddUserDetails'])->middleware(LoginCheck::class);
Route::get('/editemp', [AdminController::class, 'EditEmpData'])->middleware(LoginCheck::class);
Route::get('/editemps/{id}', [AdminController::class, 'EditEmpDatas'])->middleware(LoginCheck::class);
// Route::get('/pdfdatas', [MediaController::class, 'PDFGenerator'])->middleware(LoginCheck::class);
Route::get('/add_latest_user', [AdminController::class, 'GetLatestUser'])->middleware(LoginCheck::class);
Route::get('/homepage/{id}', [EmployeeAttendance::class, 'homepage']);
Route::get('/filter', function () {
    return view('Filter');
});





Route::put('/editedData/{id}', [AdminController::class, 'SaveEditEmpDatas'])->middleware(LoginCheck::class);
Route::post('/Entery', [EmployeeAttendance::class, 'WorkStart'])->middleware(LoginCheck::class);
Route::post('/leave', [EmployeeAttendance::class, 'WorkEnd'])->middleware(LoginCheck::class);
Route::post('/user_register', [AdminController::class, 'AddUsers'])->middleware(LoginCheck::class);
Route::post('/user_details', [AdminController::class, 'AddUserDetails'])->middleware(LoginCheck::class);
Route::post('/get_user_info', [AdminController::class, 'SearchUser'])->middleware(LoginCheck::class);
Route::post('/setholiday', [AdminController::class, 'Holidays']);
Route::post('/filter', [FilterController::class, 'apiFilterData']);
Route::post('/setweeklyholiday', [HolidayController::class, 'SetWeeklyHoliday']);


Route::view('/attendance', 'Attendance')->middleware(LoginCheck::class);
Route::view('/filters', 'Filter');




Route::prefix('/adminPanel')->middleware(AdminCheck::class)->group(function () {
    Route::get('/records', [AdminController::class, 'getData']);
    Route::view('/generate_user', 'GenerateUser');
    Route::get('/downloadData', [MediaController::class, 'PDFGenerator']);
    Route::view('/search_user', 'SearchEmployee');
    Route::view('/holiday', 'HolidaysSettings');
});
