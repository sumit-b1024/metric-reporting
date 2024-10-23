<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AirportBadgeController;
use App\Http\Controllers\SecurityGuardLicenseController;
use App\Http\Controllers\DrivingLicenseController;
use App\Http\Controllers\EightHoursCertificateController;
use App\Http\Controllers\Auth\EmployeeLoginController;
 
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();
Route::get('employee/login', [EmployeeLoginController::class, 'showLoginForm'])->name('employee.login');
Route::post('employee/login', [EmployeeLoginController::class, 'login']);
Route::post('employee/logout', [EmployeeLoginController::class, 'logout'])->name('employee.logout');
Route::middleware(['auth:employee'])->group(function () {
    Route::get('/employee/dashboard', function () {
        return view('employee.dashboard');
    })->name('employee.dashboard');
    Route::get('employees/profile/{employee}', [EmployeeController::class, 'edit'])->name('employee.profile');
    Route::put('employees/profile/update/{employee}', [EmployeeController::class, 'update'])->name('employee.profile.update');
});
Route::get('employees/export/csv', [EmployeeController::class, 'exportCsv'])->name('employees.export.csv');
Route::get('employees/export/excel', [EmployeeController::class, 'exportExcel'])->name('employees.export.excel');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);

    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::resource('employees', EmployeeController::class);
    Route::post('employees/import', [EmployeeController::class, 'import'])->name('employees.import');
    Route::resource('airport-badge', AirportBadgeController::class);
    Route::post('airport_badge/import', [AirportBadgeController::class, 'import'])->name('airport_badge.import');
    Route::resource('security-guard-licenses', SecurityGuardLicenseController::class);
    Route::post('security-guard-licenses/import', [SecurityGuardLicenseController::class, 'import'])->name('security-guard-licenses.import');
    Route::resource('driving-licenses', DrivingLicenseController::class);
    Route::post('driving-licenses/import', [DrivingLicenseController::class, 'import'])->name('driving-licenses.import');
    Route::resource('eight-hours-certificates', EightHoursCertificateController::class);
    Route::post('eight-hours-certificates/import', [EightHoursCertificateController::class, 'import'])->name('eight-hours-certificates.import');

});