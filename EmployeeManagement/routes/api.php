<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeAttendance;
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

Auth::routes();

Route::get('/apilogins', [APIController::class, 'aa']);
Route::post('/apilogin', [APIController::class, 'login']);
Route::post('/Entery/', [EmployeeAttendance::class, 'WorkStart'])->middleware(LoginCheck::class);
Route::post('/leave/', [EmployeeAttendance::class, 'WorkEnd'])->middleware(LoginCheck::class);
