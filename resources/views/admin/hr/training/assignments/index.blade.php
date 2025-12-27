@extends('layouts.admin')

@section('header', 'Workforce Training Matrix')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Active Assignments</h2>
        <p class="text-slate-500 text-sm font-medium">Monitor real-time progress of professional development programs.</p>
    </div>
    <a href="{{ route('hr-manager.trainings.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm transition-all flex items-center gap-2">
        <i data-lucide="user-check" class="w-4 h-4"></i> ASSIGN TRAINING
    </a>
</div>

<div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Personnel / Module</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Timeline</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Milestones</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($trainings as $training)
                <tr class="hover:bg-slate-50 transition-all group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 font-black text-xs border border-slate-200">
                                {{ substr($training->employee->first_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-slate-900 font-bold text-sm">{{ $training->employee->first_name }} {{ $training->employee->last_name }}</div>
                                <div class="text-[10px] font-black text-purple-600 uppercase tracking-widest mt-0.5">{{ $training->course->title }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-slate-600 text-xs font-bold">{{ $training->start_date ? $training->start_date->format('M d') : 'Pending' }} — {{ $training->end_date ? $training->end_date->format('M d, Y') : 'TBD' }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-3">
                            <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden w-24">
                                <div class="h-full {{ $training->status === 'completed' ? 'bg-emerald-500' : ($training->status === 'in_progress' ? 'bg-purple-600' : 'bg-slate-400') }}" style="width: {{ $training->status === 'completed' ? '100%' : ($training->status === 'in_progress' ? '50%' : '0%') }}"></div>
                            </div>
                            <span class="badge {{ $training->status === 'completed' ? 'badge-success' : ($training->status === 'in_progress' ? 'badge-primary' : 'badge-warning') }} text-[8px]">
                                {{ strtoupper(str_replace('_', ' ', $training->status)) }}
                            </span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <a href="{{ route('hr-manager.trainings.edit', $training->id) }}" class="p-2.5 bg-slate-50 hover:bg-slate-100 rounded-xl text-slate-400 hover:text-slate-600 border border-slate-200 transition-all">
                            <i data-lucide="settings-2" class="w-4 h-4"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-xl flex items-center justify-center text-slate-300 mx-auto mb-6 border border-slate-200">
                            <i data-lucide="calendar-check" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">No active training deployments.</h3>
                        <p class="text-slate-500 text-sm">Assign modules from the course catalog to begin certification tracking.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
