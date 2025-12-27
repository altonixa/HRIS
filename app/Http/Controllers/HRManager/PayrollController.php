<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Services\PayrollService;
use Carbon\Carbon;

class PayrollController extends Controller
{
    protected $payrollService;

    public function __construct(PayrollService $payrollService)
    {
        $this->payrollService = $payrollService;
    }

    public function index()
    {
        $payrolls = Payroll::with('employee')->latest('month')->paginate(20);
        return view('admin.hr.payroll.index', compact('payrolls'));
    }

    public function processBatch(Request $request)
    {
        $request->validate(['month' => 'required|date']);
        
        $count = $this->payrollService->generateMonthlyPayrollBatch($request->month);
        
        return back()->with('success', "Payroll batch processed for $count employees.");
    }

    public function show(Payroll $payroll)
    {
        return view('admin.hr.payroll.show', compact('payroll'));
    }

    public function downloadPayslip(Payroll $payroll)
    {
        $payroll->load(['employee.department', 'employee.designation']);
        
        $pdf = \PDF::loadView('payroll.payslip-pdf', compact('payroll'));
        
        $filename = 'payslip_' . $payroll->employee->employee_code . '_' . $payroll->month->format('Y-m') . '.pdf';
        
        return $pdf->download($filename);
    }
}
