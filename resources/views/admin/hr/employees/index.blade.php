@extends('layouts.admin')

@section('header', 'Workforce Directory')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Active Workforce</h2>
        <p class="text-slate-500 text-sm font-medium">Centralized management of all organizational personnel.</p>
    </div>
    <div class="flex items-center gap-3">
        <div class="bg-slate-100 border border-slate-200 p-1 rounded-xl flex">
            <button class="px-4 py-2 bg-purple-600 text-white rounded-lg text-xs font-bold shadow-sm transition-all">All Staff</button>
            <button class="px-4 py-2 text-slate-500 hover:text-slate-900 rounded-lg text-xs font-bold transition-all">By Dept</button>
        </div>
        <a href="{{ route('hr-manager.employees.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm transition-all flex items-center gap-2">
            <i data-lucide="user-plus" class="w-4 h-4"></i> ONBOARD TALENT
        </a>
    </div>
</div>

<!-- High-Level Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <x-kpi-card 
        icon="users" 
        label="Total Headcount" 
        :value="$employees->total()" 
        change="+2.4%" 
        changeType="positive"
        iconBg="rgba(139, 92, 246, 0.1)"
        iconColor="var(--primary)"
    />
    <x-kpi-card 
        icon="check-circle" 
        label="Active Now" 
        :value="\App\Models\Employee::where('status', 'active')->count()" 
        change="Operational" 
        changeType="positive"
        iconBg="rgba(34, 197, 94, 0.1)"
        iconColor="var(--success)"
    />
    <x-kpi-card 
        icon="clock" 
        label="On Probation" 
        :value="\App\Models\Employee::where('status', 'probation')->count()" 
        change="Review Needed" 
        changeType="warning"
        iconBg="rgba(245, 158, 11, 0.1)"
        iconColor="var(--warning)"
    />
    <x-kpi-card 
        icon="building-2" 
        label="Departments" 
        :value="\App\Models\Department::count()" 
        change="Active Units" 
        changeType="positive"
        iconBg="rgba(6, 182, 212, 0.1)"
        iconColor="var(--secondary)"
    />
</div>

<!-- Employee Table -->
<div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Personnel Identity</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Assignment / Business Unit</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Digital footprint</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Operational status</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Administrative</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($employees as $employee)
                <tr class="hover:bg-slate-50 transition-all group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 font-black text-sm border border-slate-200 shadow-sm transition-transform group-hover:scale-110">
                                @if($employee->profile_picture)
                                    <img src="{{ Storage::url($employee->profile_picture) }}" class="w-full h-full object-cover rounded-xl">
                                @else
                                    {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <div class="text-slate-900 font-bold text-sm group-hover:text-purple-600 transition-colors">{{ $employee->first_name }} {{ $employee->last_name }}</div>
                                <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-0.5">{{ $employee->employee_code }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-slate-900 font-bold text-xs">{{ $employee->designation->name ?? 'NOT ASSIGNED' }}</div>
                        <div class="text-[10px] text-purple-600 uppercase font-black tracking-widest mt-1">{{ $employee->department->name ?? 'NO DEPARTMENT' }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-slate-600 text-xs font-medium">{{ $employee->user->email ?? 'no-email' }}</div>
                        <div class="text-[10px] text-slate-400 font-bold mt-1">{{ $employee->phone ?? '--' }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="badge {{ $employee->status === 'active' ? 'badge-success' : ($employee->status === 'probation' ? 'badge-warning' : 'badge-danger') }} text-[8px]">
                            {{ strtoupper($employee->status) }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('hr-manager.employees.show', $employee->id) }}" class="p-2.5 bg-slate-50 hover:bg-slate-100 rounded-xl text-slate-400 hover:text-slate-600 border border-slate-200 transition-all shadow-sm">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                            <a href="{{ route('hr-manager.employees.edit', $employee->id) }}" class="p-2.5 bg-slate-50 hover:bg-slate-100 rounded-xl text-slate-400 hover:text-slate-600 border border-slate-200 transition-all shadow-sm">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-xl flex items-center justify-center text-slate-300 mx-auto mb-6 border border-slate-200">
                            <i data-lucide="users-2" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">The workforce is currently empty.</h3>
                        <p class="text-slate-500 text-sm max-w-sm mx-auto">Start building your organization by onboarding your first talent today.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($employees->hasPages())
    <div class="px-8 py-6 bg-slate-50 border-t border-slate-200">
        {{ $employees->links() }}
    </div>
    @endif
</div>
@endsection
