<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = \Illuminate\Support\Facades\Auth::user()->employee;
        
        $todayAttendance = \App\Models\AttendanceLog::where('employee_id', $employee->id)
            ->whereDate('clock_in', \Carbon\Carbon::today())
            ->first();
            
        $leaveBalance = \App\Models\LeaveRequest::where('employee_id', $employee->id)
            ->where('status', 'Approved')
            ->sum('duration') ?? 0;
            
        // Mocking balance for UI demonstration if needed, but here we track approved days
        // In a real system you'd subtract from an entitlement
        $leaveBalance = 15 - $leaveBalance; 
        
        $avgKpiScore = \App\Models\AppraisalReview::where('employee_id', $employee->id)
            ->avg('final_score') ?? 0;

        return view('admin.employee.dashboard', compact('todayAttendance', 'leaveBalance', 'avgKpiScore'));
    }
}
