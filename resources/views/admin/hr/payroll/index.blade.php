@extends('layouts.admin')

@section('header', 'Monthly Payroll')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 mb-1">Payroll Management</h1>
        <p class="text-slate-500 text-sm font-medium">Process monthly salaries and generate payslips.</p>
    </div>
    
    <div class="flex gap-3">
        <form action="{{ route('hr-manager.payroll.process') }}" method="POST" class="flex gap-2 items-center bg-slate-100 p-2 rounded-xl border border-slate-200">
            @csrf
            <input type="month" name="month" value="{{ date('Y-m') }}" class="bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-sm text-slate-900 focus:outline-none focus:ring-1 focus:ring-purple-600">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-1.5 rounded-lg text-sm font-bold transition-colors flex items-center gap-2">
                <i data-lucide="play" class="w-4 h-4"></i> RUN PAYROLL
            </button>
        </form>
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600 border-collapse">
            <thead class="bg-slate-50 text-[10px] uppercase font-black tracking-widest text-slate-400">
                <tr class="border-b border-slate-200">
                    <th class="px-6 py-4">Employee</th>
                    <th class="px-6 py-4">Month</th>
                    <th class="px-6 py-4">Base Salary</th>
                    <th class="px-6 py-4">Total Deductions</th>
                    <th class="px-6 py-4 font-bold text-slate-900">Net Paid</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <tr class="hover:bg-slate-50 transition-all">
                    <td class="px-6 py-4">
                        <div class="text-slate-900 font-bold text-sm">{{ $p->employee->first_name }} {{ $p->employee->last_name }}</div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $p->employee->employee_code }}</div>
                    </td>
                    <td class="px-6 py-4 font-medium">{{ $p->month->format('F Y') }}</td>
                    <td class="px-6 py-4 font-mono font-bold">{{ number_format($p->base_salary, 0) }} XAF</td>
                    <td class="px-6 py-4 font-mono text-rose-600 font-bold">-{{ number_format($p->total_deductions, 0) }} XAF</td>
                    <td class="px-6 py-4 font-mono text-emerald-600 font-black">{{ number_format($p->net_salary, 0) }} XAF</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 rounded-lg text-[10px] uppercase font-black tracking-widest bg-emerald-50 text-emerald-600 border border-emerald-100">
                            {{ strtoupper($p->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('hr-manager.payroll.show', $p->id) }}" class="p-2 bg-slate-50 hover:bg-slate-100 rounded-lg text-slate-400 hover:text-slate-600 border border-slate-200 transition-all inline-block">
                            <i data-lucide="file-text" class="w-4 h-4"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                        No payroll processed for this period. Click "Run Payroll" to start.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($payrolls->hasPages())
    <div class="p-4 border-t border-slate-100 bg-slate-50">
        {{ $payrolls->links() }}
    </div>
    @endif
</div>
@endsection
