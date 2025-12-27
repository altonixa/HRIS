@extends('layouts.admin')

@section('header', 'Payslip - ' . $payroll->employee->first_name . ' ' . $payroll->employee->last_name)

@section('content')
<div class="mb-6 flex justify-between items-center no-print">
    <a href="{{ route('hr-manager.payroll.index') }}" class="text-slate-400 hover:text-white text-sm flex items-center gap-1">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Payroll
    </a>
    <button onclick="window.print()" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
        <i data-lucide="printer" class="w-4 h-4"></i> Print Payslip
    </button>
</div>

<div class="bg-white text-slate-900 p-8 rounded-xl shadow-2xl max-w-4xl mx-auto payslip-container">
    <!-- Header -->
    <div class="flex justify-between border-b-2 border-slate-200 pb-6 mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">ALTONIXA <span class="text-primary">HRIS</span></h1>
            <p class="text-slate-500 text-sm mt-1">123 Business Avenue, Douala, Cameroon</p>
        </div>
        <div class="text-right">
            <h2 class="text-xl font-bold uppercase tracking-widest text-slate-400">Payslip</h2>
            <p class="text-slate-800 font-bold mt-1 text-lg">{{ $payroll->month->format('F Y') }}</p>
        </div>
    </div>

    <!-- Info Grid -->
    <div class="grid grid-cols-2 gap-8 mb-8">
        <div>
            <h4 class="text-xs font-bold text-slate-400 uppercase mb-2">Employee Details</h4>
            <div class="space-y-1">
                <p class="font-bold text-lg text-slate-800">{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</p>
                <p class="text-sm">ID: <span class="font-mono">{{ $payroll->employee->employee_code }}</span></p>
                <p class="text-sm">Position: {{ $payroll->employee->designation->title ?? 'Employee' }}</p>
                <p class="text-sm">Department: {{ $payroll->employee->department->name ?? 'N/A' }}</p>
            </div>
        </div>
        <div class="text-right bg-slate-50 p-4 rounded-lg border border-slate-100">
            <h4 class="text-xs font-bold text-slate-400 uppercase mb-2">Payment Info</h4>
            <div class="space-y-1 text-sm">
                <p>Status: <span class="text-emerald-600 font-bold uppercase">{{ $payroll->status }}</span></p>
                <p>Payment Date: {{ $payroll->payment_date ? $payroll->payment_date->format('d M, Y') : 'Pending' }}</p>
                <p>Currency: <strong>XAF</strong></p>
            </div>
        </div>
    </div>

    <!-- Calculations Table -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-0 border border-slate-200 rounded-lg overflow-hidden mb-8">
        <!-- Earnings -->
        <div class="p-6 border-r border-slate-200">
            <h4 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-2 mb-4">Earnings</h4>
            <table class="w-full text-sm">
                <tr class="h-8">
                    <td class="text-slate-600">Basic Salary</td>
                    <td class="text-right font-mono">{{ number_format($payroll->base_salary) }}</td>
                </tr>
                <!-- Dynamic Allowances -->
                {{-- Add looping logic here if multiple components stored --}}
                @php
                    $allowances = $payroll->employee->salaryStructure->components->where('type', 'earning') ?? [];
                @endphp
                @foreach($allowances as $allowance)
                <tr class="h-8">
                    <td class="text-slate-600">{{ $allowance->name }}</td>
                    <td class="text-right font-mono">{{ number_format($allowance->amount) }}</td>
                </tr>
                @endforeach
                <tr class="h-8 font-bold border-t border-slate-100">
                    <td class="pt-2">Gross Salary</td>
                    <td class="text-right pt-2 font-mono">{{ number_format($payroll->base_salary + $allowances->sum('amount')) }}</td>
                </tr>
            </table>
        </div>

        <!-- Deductions -->
        <div class="p-6 bg-slate-50/50">
            <h4 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-2 mb-4">Deductions</h4>
            <table class="w-full text-sm">
                @php
                    $deductions = $payroll->employee->salaryStructure->components->where('type', 'deduction') ?? [];
                    // Note: Automated Tax/CNPS are currently computed in the service and saved as part of total_deductions
                    // In a production app, we would store individual deduction line items in the payroll junction table.
                @endphp
                @foreach($deductions as $deduction)
                <tr class="h-8">
                    <td class="text-slate-600">{{ $deduction->name }}</td>
                    <td class="text-right font-mono text-rose-600">{{ number_format($deduction->amount) }}</td>
                </tr>
                @endforeach
                
                {{-- Showing derived tax/cnps for visualization --}}
                <tr class="h-8 border-t border-slate-100 font-bold">
                    <td class="pt-2">Total Deductions</td>
                    <td class="text-right pt-2 font-mono text-rose-600">{{ number_format($payroll->total_deductions) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Final Net Amount -->
    <div class="bg-slate-900 text-white p-6 rounded-lg flex justify-between items-center">
        <div>
            <p class="text-xs uppercase font-bold text-slate-400">Net Payable Amount</p>
            <p class="text-sm italic text-slate-500 mt-1">Amount in words: {{ number_format($payroll->net_salary) }} XAF</p>
        </div>
        <div class="text-right">
            <h3 class="text-3xl font-black font-mono">{{ number_format($payroll->net_salary) }} <span class="text-sm font-normal">XAF</span></h3>
        </div>
    </div>

    <!-- Footer Note -->
    <div class="mt-12 text-center text-[10px] text-slate-400 border-t border-slate-100 pt-8">
        <p>This is a computer-generated document and does not require a physical signature.</p>
        <p class="mt-1">Generated on {{ date('d M, Y H:i') }} | HRIS System v1.0</p>
    </div>
</div>

<style>
    @media print {
        .no-print { display: none !important; }
        body { background: white !important; padding: 0 !important; }
        .payslip-container { box-shadow: none !important; border: 1px solid #eee !important; width: 100% !important; max-width: 100% !important; }
        .main-content { overflow: visible !important; }
        .top-bar, .sidebar, footer { display: none !important; }
        .page-content { padding: 0 !important; }
    }
</style>
@endsection
