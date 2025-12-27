<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = \App\Models\Employee::count();
        $presentToday = \App\Models\AttendanceLog::whereDate('clock_in', today())
            ->distinct('employee_id')
            ->count('employee_id');
        $pendingLeaves = \App\Models\LeaveRequest::where('status', 'Pending')->count();
        
        // Payroll metrics
        $currentMonthPayroll = \App\Models\Payroll::whereYear('month', now()->year)
            ->whereMonth('month', now()->month)
            ->sum('net_salary');
        
        // Department breakdown
        $departmentStats = \App\Models\Department::withCount('employees')->get();
        
        // Recent activities (last 7 days attendance trend)
        $attendanceTrend = \App\Models\AttendanceLog::selectRaw('DATE(clock_in) as day, COUNT(DISTINCT employee_id) as count')
            ->where('clock_in', '>=', now()->subDays(7))
            ->groupByRaw('DATE(clock_in)')
            ->orderBy('day', 'asc')
            ->get();
        
        // Recent job applications
        $recentApplications = \App\Models\JobApplication::with('jobPosting')
            ->latest()
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalEmployees',
            'presentToday',
            'pendingLeaves',
            'currentMonthPayroll',
            'departmentStats',
            'attendanceTrend',
            'recentApplications'
        ));
    }
}
