@extends('layouts.admin')

@section('header', 'Employee Portal')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-black text-white tracking-tight">Welcome back, {{ Auth::user()->name }}</h2>
        <p class="text-slate-400 text-sm">Here's your personal workforce overview for today.</p>
    </div>
    <div class="flex items-center gap-3 bg-slate-900 border border-white/5 px-4 py-2 rounded-2xl shadow-xl">
        <div class="w-8 h-8 bg-emerald-500/10 rounded-lg flex items-center justify-center text-emerald-400">
            <i data-lucide="user" class="w-4 h-4"></i>
        </div>
        <div>
            <div class="text-[10px] font-black uppercase tracking-widest text-slate-500 leading-none mb-1">Position</div>
            <div class="text-xs font-bold text-white leading-none text-uppercase">{{ Auth::user()->employee->designation->name ?? 'EMPLOYEE' }}</div>
        </div>
    </div>
</div>

<!-- Personal KPIs -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <x-kpi-card 
        icon="clock" 
        label="Attendance Status" 
        :value="$todayAttendance ? 'CLOCKED IN' : 'NOT CLOCKED IN'" 
        :change="$todayAttendance ? 'Since ' . \Carbon\Carbon::parse($todayAttendance->clock_in)->format('H:i') : 'Action Required'"
        :changeType="$todayAttendance ? 'positive' : 'negative'"
        iconBg="rgba(139, 92, 246, 0.1)"
        iconColor="var(--primary)"
    />
    
    <x-kpi-card 
        icon="calendar" 
        label="Leave Balance" 
        :value="$leaveBalance . ' Days'" 
        change="Available for use"
        changeType="positive"
        iconBg="rgba(6, 182, 212, 0.1)"
        iconColor="var(--secondary)"
    />

    <x-kpi-card 
        icon="award" 
        label="Current Performance" 
        :value="$avgKpiScore . '%'" 
        change="Last Appraisal"
        changeType="positive"
        iconBg="rgba(34, 197, 94, 0.1)"
        iconColor="var(--success)"
    />

    <x-kpi-card 
        icon="wallet" 
        label="Next Payday" 
        :value="\Carbon\Carbon::now()->endOfMonth()->format('M d')" 
        change="Est: Processing"
        changeType="positive"
        iconBg="rgba(245, 158, 11, 0.1)"
        iconColor="var(--warning)"
    />
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left Column: Attendance & Shortcuts -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Attendance Control -->
        <div class="bg-slate-800/50 border border-white/5 rounded-3xl p-8 backdrop-blur-sm shadow-xl relative overflow-hidden">
            <div class="flex items-center gap-6">
                <div class="w-16 h-16 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                    <i data-lucide="map-pin" class="w-8 h-8"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white mb-1">Daily Time Tracking</h3>
                    <p class="text-slate-400 text-sm">Please record your presence using the controls below.</p>
                </div>
            </div>
            
            <div class="mt-8 flex gap-4">
                @if(!$todayAttendance)
                <form action="{{ route('employee.attendance.clock-in') }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="latitude" value="0">
                    <input type="hidden" name="longitude" value="0">
                    <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl font-black transition-all shadow-xl shadow-indigo-600/30 flex items-center justify-center gap-3">
                        <i data-lucide="log-in" class="w-5 h-5"></i>
                        CLOCK IN NOW
                    </button>
                </form>
                @elseif(!$todayAttendance->clock_out)
                <form action="{{ route('employee.attendance.clock-out') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full py-4 bg-rose-600 hover:bg-rose-500 text-white rounded-2xl font-black transition-all shadow-xl shadow-rose-600/30 flex items-center justify-center gap-3">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        CLOCK OUT NOW
                    </button>
                </form>
                @else
                <div class="flex-1 py-4 bg-slate-700/50 text-slate-400 rounded-2xl font-black text-center cursor-not-allowed border border-white/5">
                    DAY COMPLETED. ENJOY YOUR REST!
                </div>
                @endif
            </div>
        </div>

        <!-- Self-Service Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-slate-900 border border-white/5 p-6 rounded-3xl hover:border-indigo-500/30 transition-all group">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 bg-indigo-500/10 rounded-xl flex items-center justify-center text-indigo-400">
                        <i data-lucide="calendar-plus" class="w-5 h-5"></i>
                    </div>
                    <h4 class="text-white font-bold">Request Leave</h4>
                </div>
                <p class="text-xs text-slate-400 mb-6">Plan your time off. Submit requests for vacation, sick leave, or personal time.</p>
                <a href="{{ route('employee.leaves.create') }}" class="text-indigo-400 text-xs font-bold flex items-center gap-2">Apply Now <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
            </div>
            
            <div class="bg-slate-900 border border-white/5 p-6 rounded-3xl hover:border-secondary-500/30 transition-all group">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 bg-cyan-500/10 rounded-xl flex items-center justify-center text-cyan-400">
                        <i data-lucide="file-down" class="w-5 h-5"></i>
                    </div>
                    <h4 class="text-white font-bold">Payslips</h4>
                </div>
                <p class="text-xs text-slate-400 mb-6">Access your digital payslips and download them for your records at any time.</p>
                <a href="#" class="text-cyan-400 text-xs font-bold flex items-center gap-2">View History <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
            </div>
        </div>
    </div>

    <!-- Right Column: Info & History -->
    <div class="space-y-8">
        <!-- Announcements -->
        <div class="bg-slate-900 border border-white/5 rounded-3xl p-6 relative overflow-hidden">
            <h3 class="text-sm font-black uppercase tracking-widest text-slate-500 mb-6">Inside Altonixa</h3>
            <div class="space-y-6">
                <div class="flex gap-4">
                    <div class="w-1 h-12 bg-indigo-500 rounded-full"></div>
                    <div>
                        <div class="text-white font-bold text-sm mb-1">New Policy Update</div>
                        <p class="text-[10px] text-slate-400 leading-relaxed">Remote work policies have been updated for the new fiscal year.</p>
                        <div class="text-[10px] text-indigo-500 font-bold mt-2">READ NOTICE</div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-1 h-12 bg-emerald-500 rounded-full"></div>
                    <div>
                        <div class="text-white font-bold text-sm mb-1">Townhall Meeting</div>
                        <p class="text-[10px] text-slate-400 leading-relaxed">Join us this Friday at 3PM for our monthly strategy briefing.</p>
                        <div class="text-[10px] text-emerald-500 font-bold mt-2">ADD TO CALENDAR</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Feed -->
        <x-activity-feed title="My Recent Actions">
            @if($todayAttendance)
            <div class="activity-item">
                <div class="activity-icon bg-indigo-500/10 text-indigo-400">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Clocked In</div>
                    <div class="activity-description">Daily attendance recorded safely.</div>
                    <div class="activity-time">{{ \Carbon\Carbon::parse($todayAttendance->clock_in)->diffForHumans() }}</div>
                </div>
            </div>
            @endif
            
            <div class="activity-item opacity-50">
                <div class="activity-icon bg-slate-500/10 text-slate-400">
                    <i data-lucide="circle" class="w-4 h-4"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title text-sm">No other recent portal actions</div>
                </div>
            </div>
        </x-activity-feed>
    </div>
</div>
@endsection
