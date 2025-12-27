<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\PayrollExport;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.hr.reports.index');
    }

    public function exportPayroll(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m'
        ]);

        $month = $request->month;
        $filename = 'payroll_report_' . $month . '.xlsx';

        return Excel::download(new PayrollExport($month), $filename);
    }

    public function exportAttendance(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $filename = 'attendance_report_' . $startDate . '_to_' . $endDate . '.xlsx';

        return Excel::download(new AttendanceExport($startDate, $endDate), $filename);
    }

    public function exportPayrollPdf(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m'
        ]);

        $month = $request->month;
        $payrolls = \App\Models\Payroll::with(['employee.department', 'employee.designation'])
            ->whereYear('month', date('Y', strtotime($month)))
            ->whereMonth('month', date('m', strtotime($month)))
            ->get();

        $pdf = \PDF::loadView('reports.payroll-pdf', compact('payrolls', 'month'));
        $filename = 'payroll_report_' . $month . '.pdf';

        return $pdf->download($filename);
    }
}
