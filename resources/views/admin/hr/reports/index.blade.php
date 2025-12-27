@extends('layouts.admin')

@section('header', 'Reports & Exports')

@section('content')
<div class="container mx-auto max-w-4xl">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Payroll Reports -->
        <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-indigo-500/10 flex items-center justify-center">
                    <i data-lucide="wallet" class="w-6 h-6 text-indigo-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Payroll Reports</h3>
                    <p class="text-xs text-slate-400">Export monthly payroll data</p>
                </div>
            </div>

            <form action="{{ route('hr-manager.reports.payroll.excel') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Select Month</label>
                    <input type="month" name="month" required value="{{ now()->format('Y-m') }}" class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl font-bold transition-all flex items-center justify-center gap-2">
                        <i data-lucide="file-spreadsheet" class="w-4 h-4"></i>
                        Excel
                    </button>
                    <button type="submit" formaction="{{ route('hr-manager.reports.payroll.pdf') }}" class="flex-1 py-3 bg-rose-600 hover:bg-rose-500 text-white rounded-xl font-bold transition-all flex items-center justify-center gap-2">
                        <i data-lucide="file-text" class="w-4 h-4"></i>
                        PDF
                    </button>
                </div>
            </form>
        </div>

        <!-- Attendance Reports -->
        <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 flex items-center justify-center">
                    <i data-lucide="clock" class="w-6 h-6 text-amber-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Attendance Reports</h3>
                    <p class="text-xs text-slate-400">Export attendance logs by date range</p>
                </div>
            </div>

            <form action="{{ route('hr-manager.reports.attendance.excel') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Start Date</label>
                    <input type="date" name="start_date" required value="{{ now()->startOfMonth()->format('Y-m-d') }}" class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">End Date</label>
                    <input type="date" name="end_date" required value="{{ now()->format('Y-m-d') }}" class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl font-bold transition-all flex items-center justify-center gap-2">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    Export to Excel
                </button>
            </form>
        </div>
    </div>

    <!-- Info Box -->
    <div class="mt-8 bg-indigo-500/10 border border-indigo-500/20 rounded-2xl p-6">
        <div class="flex items-start gap-3">
            <i data-lucide="info" class="w-5 h-5 text-indigo-400 mt-0.5"></i>
            <div>
                <h4 class="text-sm font-bold text-white mb-2">Export Information</h4>
                <ul class="text-xs text-slate-400 space-y-1">
                    <li>• Excel exports include all detailed columns for analysis</li>
                    <li>• PDF reports provide formatted summaries for printing</li>
                    <li>• Attendance reports show clock in/out times and duration</li>
                    <li>• All exports are generated in real-time from current data</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
