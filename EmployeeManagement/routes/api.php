<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIController;
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

Route::post('/apilogin', [APIController::class, 'login']);

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::post('/logout', [EmployeeAttendance::class, 'APILogout']); //logout
    Route::post('/logdata', [EmployeeAttendance::class, 'APILoggedUserData']); //Gives the Data of Current logged in user
    Route::post('/entry/', [EmployeeAttendance::class, 'WorkStart']); //Checkin 
    Route::post('/leave/', [EmployeeAttendance::class, 'WorkEnd']); //Checkout
    Route::get('/attendance/{id}', [EmployeeAttendance::class, 'APIEmployeeAttendance']); //History
    Route::get('/get_wifi', [AdminController::class, 'GetWifi']);

    Route::post('/get_user_info', [AdminController::class, 'apiSearchUser']); //search the user
    Route::post('/add_wifi', [AdminController::class, 'AddWifiData']); //Add the user wifi Details



    // Route::post('/ipaddress', [EmployeeAttendance::class, 'IPDatas']); //Get Ipaddress
    // Route::post('/getuserlocation', [EmployeeAttendance::class, 'Location']); //Get User Location Data
    // Route::post('/addwifi', [EmployeeAttendance::class, 'AddWifiData']); //Add the wifi Data
    // Route::get('/getwifi', [EmployeeAttendance::class, 'GetNetworkData']); //get wifi data
    // Route::post('/getmac', [EmployeeAttendance::class, 'getMacaddress']); //Get Macaddress


    // Route::post('/filter', [FilterController::class, 'apiFilterData']); //get emp data related to attendance
    Route::prefix('/adminPanel')->middleware(AdminCheck::class)->group(function () {
        Route::get('/get_emp_details', [AdminController::class, 'APIhello']);
        Route::get('/records', [AdminController::class, 'apigetData']); //get the record
        Route::get('/downloadData', [MediaController::class, 'apiPDFGenerator']); //Download Data 
    });
});
