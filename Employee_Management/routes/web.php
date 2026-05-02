<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\HR;
use App\Http\Controllers\Manager;
use App\Http\Controllers\Employee;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    // Redirect dashboard by role
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ADMIN 
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        // Users
        Route::resource('users', Admin\UserController::class);
        // Departments
        Route::resource('departments', Admin\DepartmentController::class);
        // View Employees
        Route::get('employees', [Admin\EmployeeViewController::class, 'index'])->name('employees.index');
        Route::get('employees/{employee}', [Admin\EmployeeViewController::class, 'show'])->name('employees.show');
        Route::get('logs', [Admin\ActivityLogController::class, 'index'])->name('logs.index');

    });

    // HR 
    Route::prefix('hr')->name('hr.')->middleware('role:hr,admin')->group(function () {
        Route::resource('employees', HR\EmployeeController::class)->except(['destroy']);
        Route::resource('payslips', HR\PayslipController::class)->except(['destroy']);
        Route::get('leaves', [HR\LeaveMonitorController::class, 'index'])->name('leaves.index');
        Route::get('leaves/{leaveRequest}', [HR\LeaveMonitorController::class, 'show'])->name('leaves.show');
        Route::resource('attendance', HR\AttendanceController::class)->except(['show']); // ✅ add this
    });

    // MANAGER 
    Route::prefix('manager')->name('manager.')->middleware('role:manager')->group(function () {
        Route::get('team', [Manager\TeamController::class, 'index'])->name('team.index');
        Route::get('team/{employee}', [Manager\TeamController::class, 'show'])->name('team.show');
        Route::get('leaves', [Manager\LeaveApprovalController::class, 'index'])->name('leaves.index');
        Route::patch('leaves/{leaveRequest}', [Manager\LeaveApprovalController::class, 'update'])->name('leaves.update');
    });

    // EMPLOYEE 
    Route::prefix('employee')->name('employee.')->middleware('role:employee')->group(function () {
        Route::get('profile', [Employee\ProfileController::class, 'show'])->name('profile');
        Route::patch('profile', [Employee\ProfileController::class, 'update'])->name('profile.update');
        Route::get('payslips', [Employee\PayslipController::class, 'index'])->name('payslips.index');
        Route::get('payslips/{payslip}', [Employee\PayslipController::class, 'show'])->name('payslips.show');
        Route::get('leaves', [Employee\LeaveController::class, 'index'])->name('leaves.index');
        Route::get('leaves/create', [Employee\LeaveController::class, 'create'])->name('leaves.create');
        Route::post('leaves', [Employee\LeaveController::class, 'store'])->name('leaves.store');
        Route::get('leaves/{leaveRequest}', [Employee\LeaveController::class, 'show'])->name('leaves.show');
        Route::get('attendance', [Employee\AttendanceController::class, 'index'])->name('attendance.index');
    });
});

require __DIR__ . '/auth.php';