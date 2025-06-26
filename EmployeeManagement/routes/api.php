<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HolidayController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeAttendance;
use App\Http\Controllers\UserWifiData;
use App\Http\Controllers\MediaController;
use App\Http\Middleware\AddUserDetailsCheck;
// use App\Models\ExtraUserData;
use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\LoginCheck;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Auth::routes();

Route::post('/register', [APIController::class, 'Registration']);
Route::post('/apilogin', [APIController::class, 'login']);

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::post('/logout', [EmployeeAttendance::class, 'APILogout']); //logout
    Route::post('/logdata', [EmployeeAttendance::class, 'APILoggedUserData']); //Gives the Data of Current logged in user
    Route::post('/entry', [EmployeeAttendance::class, 'APIWorkStart']); //Checkin 
    Route::post('/leave', [EmployeeAttendance::class, 'APIWorkEnd']); //Checkout
    Route::get('/empfilter/{id}', [EmployeeAttendance::class, 'APIFilteration']);
    Route::get('/attendance/{id}', [EmployeeAttendance::class, 'APIEmployeeAttendance']); //History
    Route::get('/get_wifi', [AdminController::class, 'GetWifi']);

    Route::post('/get_user_info', [AdminController::class, 'apiSearchUser']); //search the user
    Route::post('/add_wifi', [AdminController::class, 'AddWifiData']); //Add the user wifi Details

    Route::prefix('/adminPanel')->middleware(AdminCheck::class)->group(function () {
        Route::get('/get_emp_details', [AdminController::class, 'APIhello']);
        Route::get('/records', [AdminController::class, 'apigetData']); //get the record
        Route::get('/downloadData', [MediaController::class, 'apiPDFGenerator']); //Download Data 
        Route::put('/editedData/{id}', [AdminController::class, 'APISaveEditEmpDatas']); //Edit Employee Data
        Route::delete('/deleteemps/{id}', [AdminController::class, 'APIDeleteEmpDatas']); //Remove Employee Data
        Route::post('/setweeklyholiday', [HolidayController::class, 'APISetWeeklyHoliday']); //Set Weekly Holidays
        Route::post('/setholiday', [AdminController::class, 'APIHolidays']); //Set Festival Holidays
        Route::post('/set_time', [AdminController::class, 'APITimeManagement']); //Set office time
        Route::get('/trash_user', [AdminController::class, 'APITrashedUserList']); //Get the Trashed User
        Route::get('/restore/{id}', [AdminController::class, 'APIRestoreUsers']); //Recover the User Data
        Route::get('/remove/{id}', [AdminController::class, 'APIRemoveUser']); //Remove emp data from the trash bin
        Route::get('/filter/{id}', [FilterController::class, 'apiFilterData']); //get emp data related to attendance
    });
});
