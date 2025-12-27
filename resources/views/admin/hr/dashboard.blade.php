@extends('layouts.admin')

@section('header', 'Human Resources Operations')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">HR Operations Center</h2>
        <p class="text-slate-500 text-sm font-medium">Managing recruitment, attendance, and payroll across the organization.</p>
    </div>
    <div class="flex items-center gap-3 bg-white border border-slate-200 px-4 py-2 rounded-xl shadow-sm">
        <div class="w-8 h-8 bg-purple-500/10 rounded-lg flex items-center justify-center text-purple-600">
            <i data-lucide="award" class="w-4 h-4"></i>
        </div>
        <div>
            <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 leading-none mb-1">Authenticated as</div>
            <div class="text-xs font-bold text-slate-900 leading-none">HR ADMINISTRATOR</div>
        </div>
    </div>
</div>

<!-- Operational KPIs -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <x-kpi-card 
        icon="users" 
        label="Active Staff" 
        :value="$totalEmployees" 
        change="View All" 
        changeType="positive"
        iconBg="rgba(139, 92, 246, 0.1)"
        iconColor="var(--primary)"
    />
    
    <x-kpi-card 
        icon="clock" 
        label="Pending Leaves" 
        :value="$pendingLeaves" 
        change="Review Required"
        changeType="negative"
        iconBg="rgba(245, 158, 11, 0.1)"
        iconColor="var(--warning)"
    />

    <x-kpi-card 
        icon="user-plus" 
        label="Active Openings" 
        :value="$activeJobs" 
        change="Recruitment Active"
        changeType="positive"
        iconBg="rgba(6, 182, 212, 0.1)"
        iconColor="var(--secondary)"
    />

    <x-kpi-card 
        icon="wallet" 
        label="Payroll Status" 
        :value="$payrollProcessed ? 'COMPLETE' : 'PENDING'" 
        :change="$payrollProcessed ? 'Cycle Closed' : 'Process Now'"
        :changeType="$payrollProcessed ? 'positive' : 'negative'"
        iconBg="rgba(34, 197, 94, 0.1)"
        iconColor="var(--success)"
    />
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left Column: Tasks & Pipelines -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Quick Action Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <x-quick-action icon="user-plus" href="{{ route('hr-manager.employees.create') }}">Add Employee</x-quick-action>
            <x-quick-action icon="file-spreadsheet" href="{{ route('hr-manager.payroll.index') }}">Run Payroll</x-quick-action>
            <x-quick-action icon="briefcase" href="{{ route('hr-manager.recruitment.create') }}">Post Job</x-quick-action>
        </div>

        <!-- Recruitment Pipeline -->
        <div class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-slate-900">Recruitment Pipeline</h3>
                <a href="{{ route('hr-manager.applications.index') }}" class="text-xs font-bold text-purple-600 hover:text-purple-700 transition-colors">View All Applications</a>
            </div>
            
            <div class="space-y-6">
                @forelse($recentApplications as $app)
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-purple-500/30 transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold">
                            {{ substr($app->full_name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-slate-900 font-bold text-sm">{{ $app->full_name }}</div>
                            <div class="text-[10px] text-slate-500 uppercase font-black tracking-widest">{{ $app->jobPosting->title }}</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="badge badge-primary text-[8px]">{{ $app->status }}</span>
                        <a href="{{ route('hr-manager.applications.show', $app->id) }}" class="p-2 hover:bg-slate-100 rounded-lg text-slate-400 hover:text-slate-600 transition-all">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
                @empty
                <p class="text-center text-slate-500 py-8 text-sm italic">No recent applications found.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Right Column: Operations -->
    <div class="space-y-8">
        <!-- Leave Approvals Hub -->
        <div class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Leave Operations</h3>
            <div class="space-y-4">
                @if($pendingLeaves > 0)
                <div class="p-4 bg-amber-50 border border-amber-100 rounded-xl">
                    <div class="flex items-center gap-3 mb-2">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-amber-600"></i>
                        <span class="text-amber-600 font-bold text-xs uppercase tracking-widest">Action Required</span>
                    </div>
                    <p class="text-xs text-slate-500 mb-4 font-medium">There are {{ $pendingLeaves }} employee leave requests waiting for your review.</p>
                    <a href="{{ route('hr-manager.leaves.index') }}" class="block w-full text-center py-2 bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold rounded-xl transition-all shadow-sm">
                        GO TO LEAVE HUB
                    </a>
                </div>
                @else
                <div class="text-center py-8">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-full flex items-center justify-center text-emerald-600 mx-auto mb-4">
                        <i data-lucide="check" class="w-6 h-6"></i>
                    </div>
                    <p class="text-xs text-slate-500 font-medium italic">All leave requests cleared!</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Activity Feed -->
        <x-activity-feed title="Operational Logs">
            <div class="activity-item">
                <div class="activity-icon bg-purple-500/10 text-purple-600">
                    <i data-lucide="shield" class="w-4 h-4"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title text-slate-900">System Integrity Check</div>
                    <div class="activity-description text-slate-500">Immutable audit logs synchronized with master server.</div>
                    <div class="activity-time text-slate-400">Real-time</div>
                </div>
            </div>
        </x-activity-feed>
    </div>
</div>
@endsection
