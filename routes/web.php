<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LeadController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('landing');
})->name('public.home');

Route::get('/features', function () {
    return view('public.features');
})->name('public.features');

Route::get('/security', function () {
    return view('public.security');
})->name('public.security');

Route::get('/about', function () {
    return view('public.about');
})->name('public.about');

Route::post('/demo-request', [App\Http\Controllers\LeadController::class, 'store'])->name('demo.request');

// Public Career Portal
Route::get('/careers', [App\Http\Controllers\Public\CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{job}', [App\Http\Controllers\Public\CareerController::class, 'show'])->name('careers.show');
Route::post('/careers/{job}/apply', [App\Http\Controllers\Public\CareerController::class, 'apply'])->name('careers.apply');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Central Redirect Logic
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Super Admin Portal
    Route::middleware(['auth', 'role:Super Admin'])->prefix('super-admin')->name('super-admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\SuperAdmin\DashboardController::class, 'index'])->name('dashboard');
        
        // User Management
        Route::resource('users', App\Http\Controllers\SuperAdmin\UserController::class);
        Route::post('users/{user}/reset-password', [App\Http\Controllers\SuperAdmin\UserController::class, 'resetPassword'])->name('users.reset-password');
        
        // Role & Permission Management
        Route::resource('roles', App\Http\Controllers\SuperAdmin\RoleController::class);
        
        // System Settings
        Route::get('settings', [App\Http\Controllers\SuperAdmin\SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [App\Http\Controllers\SuperAdmin\SettingController::class, 'update'])->name('settings.update');
        
        // Audit Logs
        Route::get('audit-logs', [App\Http\Controllers\SuperAdmin\AuditController::class, 'index'])->name('audit.index');
    });

    // HR Manager Portal
    Route::middleware(['role:HR Manager'])->prefix('hr')->name('hr-manager.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\HRManager\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('employees', App\Http\Controllers\HRManager\EmployeeController::class);
        
        // Leave Management
        Route::resource('leaves', App\Http\Controllers\HRManager\LeaveController::class)->only(['index', 'update']);
        
        // Shift Management
        Route::resource('shifts', App\Http\Controllers\HRManager\ShiftController::class);

        // Payroll & Salaries
        Route::resource('salaries', App\Http\Controllers\HRManager\SalaryController::class);
        Route::get('/payroll', [App\Http\Controllers\HRManager\PayrollController::class, 'index'])->name('payroll.index');
        Route::post('/payroll/process', [App\Http\Controllers\HRManager\PayrollController::class, 'processBatch'])->name('payroll.process');
        Route::get('/payroll/{payroll}', [App\Http\Controllers\HRManager\PayrollController::class, 'show'])->name('payroll.show');
        Route::get('/payroll/{payroll}/download', [App\Http\Controllers\HRManager\PayrollController::class, 'downloadPayslip'])->name('payroll.download');

        // Performance Management
        Route::resource('kpis', App\Http\Controllers\HRManager\KPIController::class);
        Route::resource('appraisals', App\Http\Controllers\HRManager\AppraisalReviewController::class);

        // Recruitment & ATS
        Route::resource('recruitment', App\Http\Controllers\HRManager\RecruitmentController::class)->parameters(['recruitment' => 'job_posting']);
        Route::get('applications', [App\Http\Controllers\HRManager\ApplicationController::class, 'index'])->name('applications.index');
        Route::get('applications/{application}', [App\Http\Controllers\HRManager\ApplicationController::class, 'show'])->name('applications.show');
        Route::patch('applications/{application}', [App\Http\Controllers\HRManager\ApplicationController::class, 'update'])->name('applications.update');

        // Reports & Exports
        Route::get('/reports', [App\Http\Controllers\HRManager\ReportController::class, 'index'])->name('reports.index');
        Route::post('/reports/payroll/excel', [App\Http\Controllers\HRManager\ReportController::class, 'exportPayroll'])->name('reports.payroll.excel');
        Route::post('/reports/payroll/pdf', [App\Http\Controllers\HRManager\ReportController::class, 'exportPayrollPdf'])->name('reports.payroll.pdf');
        Route::post('/reports/attendance/excel', [App\Http\Controllers\HRManager\ReportController::class, 'exportAttendance'])->name('reports.attendance.excel');

        // Employee specialized modules
        Route::post('/documents', [App\Http\Controllers\HRManager\DocumentController::class, 'store'])->name('documents.store');
        Route::delete('/documents/{document}', [App\Http\Controllers\HRManager\DocumentController::class, 'destroy'])->name('documents.destroy');
        Route::post('/emergency-contacts', [App\Http\Controllers\HRManager\EmergencyContactController::class, 'store'])->name('emergency-contacts.store');
        Route::delete('/emergency-contacts/{contact}', [App\Http\Controllers\HRManager\EmergencyContactController::class, 'destroy'])->name('emergency-contacts.destroy');

        // Training & Development
        Route::resource('courses', App\Http\Controllers\HRManager\CourseController::class);
        Route::resource('trainings', App\Http\Controllers\HRManager\TrainingController::class);
        Route::resource('skills', App\Http\Controllers\HRManager\SkillController::class);
        Route::post('/employee-skills', [App\Http\Controllers\HRManager\EmployeeSkillController::class, 'store'])->name('employee-skills.store');
        Route::delete('/employee-skills/{employee_skill}', [App\Http\Controllers\HRManager\EmployeeSkillController::class, 'destroy'])->name('employee-skills.destroy');
        Route::resource('expenses', App\Http\Controllers\HRManager\ExpenseController::class);
        Route::resource('assets', App\Http\Controllers\HRManager\AssetController::class);
        Route::post('/assets/{asset}/assign', [App\Http\Controllers\HRManager\AssetController::class, 'assign'])->name('assets.assign');
        Route::post('/assets/assignments/{assignment}/return', [App\Http\Controllers\HRManager\AssetController::class, 'return'])->name('assets.return');
    });

    // Department Head Portal
    Route::middleware(['role:Department Head'])->prefix('department')->name('department-head.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\DepartmentHead\DashboardController::class, 'index'])->name('dashboard');
    });

    // Accountant Portal
    Route::middleware(['role:Accountant'])->prefix('finance')->name('accountant.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Accountant\DashboardController::class, 'index'])->name('dashboard');
    });

    // Employee Portal
    Route::middleware(['role:Employee'])->prefix('employee')->name('employee.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Employee\DashboardController::class, 'index'])->name('dashboard');
        
        // Profile
        Route::get('/my-profile', [App\Http\Controllers\Employee\ProfileController::class, 'index'])->name('profile');

        // Attendance
        Route::get('/attendance', [App\Http\Controllers\Employee\AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/attendance/clock-in', [App\Http\Controllers\Employee\AttendanceController::class, 'clockIn'])->name('attendance.clock-in');
        Route::post('/attendance/clock-out', [App\Http\Controllers\Employee\AttendanceController::class, 'clockOut'])->name('attendance.clock-out');

        // Leaves
        Route::resource('leaves', App\Http\Controllers\Employee\LeaveController::class);

        // Performance (Self-Appraisal)
        Route::resource('appraisals', App\Http\Controllers\Employee\AppraisalController::class);

        // Trainings
        Route::get('/trainings', [App\Http\Controllers\Employee\TrainingController::class, 'index'])->name('trainings.index');

        // Expenses
        Route::resource('expenses', App\Http\Controllers\Employee\ExpenseController::class);

        // Assets
        Route::get('/my-assets', [App\Http\Controllers\Employee\AssetController::class, 'index'])->name('assets.index');
    });
});
