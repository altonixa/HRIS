<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\AttendanceLog;
use App\Models\LeaveRequest;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();
        $presentToday = AttendanceLog::whereDate('clock_in', Carbon::today())
            ->distinct('employee_id')
            ->count('employee_id');
            
        $pendingLeaves = LeaveRequest::where('status', 'Pending')->count();
        
        $activeJobs = \App\Models\JobPosting::where('status', 'published')->count();
        
        $recentApplications = \App\Models\JobApplication::with('jobPosting')
            ->where('status', 'New')
            ->latest()
            ->take(5)
            ->get();
            
        $payrollProcessed = \App\Models\Payroll::whereYear('month', now()->year)
            ->whereMonth('month', now()->month)
            ->exists();
        
        return view('admin.hr.dashboard', compact(
            'totalEmployees', 
            'presentToday', 
            'pendingLeaves',
            'activeJobs',
            'recentApplications',
            'payrollProcessed'
        ));
    }
}
