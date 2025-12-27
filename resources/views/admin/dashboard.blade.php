@extends('layouts.admin')

@section('header', 'Executive Insights')

@section('content')
<!-- Role Badge -->
<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Organization Overview</h2>
        <p class="text-slate-500 text-sm">Real-time performance and workforce metrics across all departments.</p>
    </div>
    <div class="flex items-center gap-3 bg-white border border-slate-200 px-4 py-2 rounded-2xl shadow-sm">
        <div class="w-8 h-8 bg-emerald-500/10 rounded-lg flex items-center justify-center text-emerald-600">
            <i data-lucide="shield" class="w-4 h-4"></i>
        </div>
        <div>
            <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 leading-none mb-1">Authenticated as</div>
            <div class="text-xs font-bold text-slate-900 leading-none">EXECUTIVE DIRECTOR</div>
        </div>
    </div>
</div>

<!-- KPI Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <x-kpi-card 
        icon="users" 
        label="Total Workforce" 
        :value="$totalEmployees" 
        change="+2.4%" 
        changeType="positive"
        iconBg="rgba(5, 150, 105, 0.1)"
        iconColor="#059669"
    />
    
    <x-kpi-card 
        icon="user-check" 
        label="Attendance Rate" 
        :value="round(($presentToday / max($totalEmployees, 1)) * 100) . '%'" 
        change="Active: $presentToday"
        changeType="positive"
        iconBg="rgba(16, 185, 129, 0.1)"
        iconColor="#10b981"
    />

    <x-kpi-card 
        icon="coffee" 
        label="Pending Leaves" 
        :value="$pendingLeaves" 
        change="Action Required"
        changeType="negative"
        iconBg="rgba(245, 158, 11, 0.1)"
        iconColor="#f59e0b"
    />

    <x-kpi-card 
        icon="banknote" 
        label="Monthly Payroll" 
        :value="number_format($currentMonthPayroll) . ' FCFA'" 
        change="Current Cycle"
        changeType="positive"
        iconBg="rgba(14, 165, 233, 0.1)"
        iconColor="#0ea5e9"
    />
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Chart Section -->
    <div class="lg:col-span-2">
        <x-chart-card title="7-Day Attendance Trend">
            <x-slot name="actions">
                <select class="bg-slate-50 border border-slate-200 text-xs font-bold text-slate-500 rounded-lg px-3 py-1.5 focus:ring- emerald-500/20 outline-none">
                    <option>Last 7 Days</option>
                    <option>Last 30 Days</option>
                </select>
            </x-slot>
            <div class="h-[300px]">
                <canvas id="attendanceChart"></canvas>
            </div>
        </x-chart-card>
    </div>

    <!-- Quick Actions -->
    <div class="space-y-6">
        <h3 class="text-sm font-black uppercase tracking-widest text-slate-400">Executive Shortcuts</h3>
        <div class="grid grid-cols-1 gap-3">
            <x-quick-action 
                icon="plus-circle" 
                href="{{ route('hr-manager.employees.create') }}"
                iconBg="rgba(5, 150, 105, 0.1)" 
                iconColor="#059669"
            >
                Onboard New Staff
            </x-quick-action>
            <x-quick-action 
                icon="file-text" 
                href="{{ route('hr-manager.payroll.index') }}"
                iconBg="rgba(14, 165, 233, 0.1)" 
                iconColor="#0ea5e9"
            >
                Review Payroll
            </x-quick-action>
            <x-quick-action 
                icon="briefcase" 
                href="{{ route('hr-manager.recruitment.index') }}"
                iconBg="rgba(16, 185, 129, 0.1)" 
                iconColor="#10b981"
            >
                Manage Openings
            </x-quick-action>
            <x-quick-action 
                icon="download" 
                href="{{ route('hr-manager.reports.index') }}"
                iconBg="rgba(245, 158, 11, 0.1)" 
                iconColor="#f59e0b"
            >
                Export Reports
            </x-quick-action>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Department Distribution -->
    <div class="bg-white border border-slate-100 rounded-xl p-8 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-6">Departmental Headcount</h3>
        <div class="space-y-4">
            @foreach($departmentStats as $dept)
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-semibold text-slate-500">{{ $dept->name }}</span>
                    <span class="text-sm font-bold text-slate-900">{{ $dept->employees_count }}</span>
                </div>
                <div class="progress-bar bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div class="progress-fill bg-emerald-500 h-full rounded-full" style="width: {{ ($dept->employees_count / max($totalEmployees, 1)) * 100 }}%;"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Activity Feed -->
    <x-activity-feed title="System Intelligence Feed">
        @foreach($recentApplications as $app)
        <div class="activity-item py-4 flex items-start gap-4 border-b border-slate-50 last:border-0">
            <div class="activity-icon w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
            </div>
            <div class="activity-content">
                <div class="text-sm font-bold text-slate-900">New Application Received</div>
                <div class="text-xs text-slate-500"><b>{{ $app->full_name }}</b> applied for <b>{{ $app->jobPosting->title }}</b></div>
                <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase">{{ $app->created_at->diffForHumans() }}</div>
            </div>
        </div>
        @endforeach
        
        <div class="activity-item py-4 flex items-start gap-4 border-b border-slate-50 last:border-0">
            <div class="activity-icon w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                <i data-lucide="shield-check" class="w-4 h-4"></i>
            </div>
            <div class="activity-content">
                <div class="text-sm font-bold text-slate-900">System Audit Log Exported</div>
                <div class="text-xs text-slate-500">Immutable audit report generated by System Super Admin</div>
                <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase">5 hours ago</div>
            </div>
        </div>
    </x-activity-feed>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const attendanceData = {
        labels: [@foreach($attendanceTrend as $item)'{{ \Carbon\Carbon::parse($item->day)->format('M d') }}',@endforeach],
        datasets: [{
            label: 'Attendance',
            data: [@foreach($attendanceTrend as $item){{ $item->count }},@endforeach],
            borderColor: '#059669',
            backgroundColor: 'rgba(5, 150, 105, 0.05)',
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#059669',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6
        }]
    };

    new Chart(document.getElementById('attendanceChart'), {
        type: 'line',
        data: attendanceData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#0f172a',
                    bodyColor: '#64748b',
                    borderColor: '#f1f5f9',
                    borderWidth: 1,
                    padding: 12,
                    borderRadius: 12,
                    displayColors: false,
                    titleFont: { weight: 'bold' }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#94a3b8', font: { size: 10, weight: '600' } },
                    grid: { color: '#f8fafc' }
                },
                x: {
                    ticks: { color: '#94a3b8', font: { size: 10, weight: '600' } },
                    grid: { display: false }
                }
            }
        }
    });
</script>
@endpush
@endsection
