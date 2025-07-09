<?php

use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeAttendance;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\MediaController;
// use App\Models\ExtraUserData;
use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\LoginCheck;


Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', function () {
    $isUserEmpty = User::doesntExist();

    if ($isUserEmpty) {
        return view('auth.register');
    } else {
        return redirect()->route('login');
    }
})->name('register');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(LoginCheck::class);
Route::get('/attendance/{id}', [EmployeeAttendance::class, 'EmployeeAttendance'])->middleware(LoginCheck::class);
Route::get('/adminPanel', [AdminController::class, 'hello'])->middleware(AdminCheck::class);
Route::get('/user_details_view', [AdminController::class, 'GetLatestUser'])->middleware(LoginCheck::class); //Form the user adding form
Route::get('/editemp', [AdminController::class, 'EditEmpData'])->middleware(LoginCheck::class);
Route::get('/editemps/{id}', [AdminController::class, 'EditEmpDatas'])->middleware(LoginCheck::class);
Route::get('/deleteemps/{id}', [AdminController::class, 'DeleteEmpDatas'])->middleware(LoginCheck::class);
Route::get('/pdfdatas', [MediaController::class, 'PDFGenerator'])->middleware(LoginCheck::class);
Route::get('/homepage/{id}', [EmployeeAttendance::class, 'homepage'])->middleware(LoginCheck::class);


// Route::get('/add_latest_user', [AdminController::class, 'GetLatestUser'])->middleware(LoginCheck::class); 
//Hit this URL if you newly Installed the System but before visit the /register url in browser
Route::get('/add_new_system', [AdminController::class, 'NewSystemInstallation'])->middleware(LoginCheck::class);


Route::get('/filter', function () {
    return view('Filter');
})->middleware(LoginCheck::class);
Route::get('get_user_info', function () {
    return view('SearchEmployee');
})->middleware(LoginCheck::class);
Route::get('/restore/{id}', [AdminController::class, 'RestoreUsers'])->middleware(LoginCheck::class);
Route::get('/remove/{id}', [AdminController::class, 'RemoveUser'])->middleware(LoginCheck::class);
Route::get('/mark_as_read', [LeaveController::class, 'MarkAsRead'])->middleware(LoginCheck::class);
Route::get('/leave', [LeaveController::class, 'EmpLeaveList'])->middleware(LoginCheck::class);
Route::get('empfilter/{id}', [EmployeeAttendance::class, 'Filteration']);





Route::put('/editedData/{id}', [AdminController::class, 'SaveEditEmpDatas'])->middleware(LoginCheck::class);
Route::post('/Entery', [EmployeeAttendance::class, 'WorkStart'])->middleware(LoginCheck::class);
Route::post('/leave', [EmployeeAttendance::class, 'WorkEnd'])->middleware(LoginCheck::class);
Route::post('/user_register', [AdminController::class, 'AddUsers'])->middleware(LoginCheck::class);
Route::post('/user_details', [AdminController::class, 'AddUserDetails'])->middleware(LoginCheck::class);
// Route::post('/user_details', [AdminController::class, function (Request $request) {
//     dd($request::all());
// }])->middleware(LoginCheck::class);
Route::post('/get_user_info', [AdminController::class, 'SearchUser'])->middleware(LoginCheck::class);
Route::post('/setholiday', [AdminController::class, 'Holidays'])->middleware(LoginCheck::class);
Route::post('/filter', [FilterController::class, 'FilterData'])->middleware(LoginCheck::class);
Route::post('/setweeklyholiday', [HolidayController::class, 'SetWeeklyHoliday'])->middleware(LoginCheck::class);
Route::post('/set_time', [AdminController::class, 'TimeManagement'])->middleware(LoginCheck::class);
Route::post('/ask_leave', [LeaveController::class, 'GetLeaves'])->middleware(LoginCheck::class);


Route::view('/attendance', 'Attendance')->middleware(LoginCheck::class);
Route::view('/filters', 'Filter')->middleware(LoginCheck::class);
Route::view('/empfilter', 'EmployeeAttendanceFilter')->middleware(LoginCheck::class);
// Route::view('/leave', 'EmpLeaveSection')->middleware(LoginCheck::class);
Route::view('/extraDetails', 'EployeeDetails'); //dont delete this comment



Route::prefix('/adminPanel')->middleware(AdminCheck::class)->group(function () {
    Route::view('/generate_user', 'GenerateUser')->name('generate.user');
    Route::view('/holiday', 'HolidaysSettings');
    Route::view('/search_user', 'SearchEmployee')->name('searchUser');
    // Route::view('/checkout', 'EmployeeCheckout');
    Route::get('/checkout', [AdminController::class, 'EmpCheckout']);
    Route::get('/records', [AdminController::class, 'getData']);
    Route::get('/trash_user', [AdminController::class, 'TrashedUserList']);
    Route::get('/downloadData', [MediaController::class, 'PDFGenerator']);
    Route::get('/custome_holiday_number', [AdminController::class, 'GetCustomeHolidays']);
    Route::get('/empleave', [AdminController::class, 'LeveDataCollection']);
    Route::get('/approve/{id}', [LeaveController::class, 'Approve']);
    Route::get('/reject/{id}', [LeaveController::class, 'Reject']);
    Route::get('/emp_data_filteration', [EmployeeAttendance::class, 'EmpfilterData']);

    Route::get('/checkout_emp', [AdminController::class, 'EmployeeCheckout']);
    // Route::get('/home', 'Admin');
});
