@extends('layouts.admin')

@section('header', 'Appraisal Management')

@section('content')
<div class="container mx-auto">
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-indigo-500/10 border border-indigo-500/20 rounded-2xl p-6 backdrop-blur-sm">
            <p class="text-xs font-bold text-indigo-400 uppercase tracking-widest">Total Appraisals</p>
            <p class="text-2xl font-black text-white">{{ $appraisals->total() }}</p>
        </div>
        <div class="bg-amber-500/10 border border-amber-500/20 rounded-2xl p-6 backdrop-blur-sm">
            <p class="text-xs font-bold text-amber-400 uppercase tracking-widest">Pending Review</p>
            <p class="text-2xl font-black text-white">{{ $appraisals->where('status', 'Submitted')->count() }}</p>
        </div>
        <!-- Add more stats if needed -->
    </div>

    <!-- Table -->
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 border-b border-white/5">
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Employee</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Department</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Period</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Score</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($appraisals as $appraisal)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-700 overflow-hidden">
                                     @if($appraisal->employee->profile_picture)
                                        <img src="{{ Storage::url($appraisal->employee->profile_picture) }}" class="w-full h-full object-cover">
                                     @else
                                        <div class="w-full h-full flex items-center justify-center text-xs font-bold text-white">
                                            {{ substr($appraisal->employee->first_name, 0, 1) }}
                                        </div>
                                     @endif
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-white">{{ $appraisal->employee->first_name }} {{ $appraisal->employee->last_name }}</p>
                                    <p class="text-xs text-slate-500">{{ $appraisal->employee->designation->name ?? 'Employee' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold text-slate-300">{{ $appraisal->employee->department->name ?? 'N/A' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-medium text-slate-400">{{ $appraisal->period_end->format('M Y') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'Draft' => 'bg-slate-700/50 text-slate-300 border-slate-600',
                                    'Submitted' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                    'Reviewed' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    'Finalized' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                ];
                                $class = $statusClasses[$appraisal->status] ?? 'bg-slate-700 text-slate-300';
                            @endphp
                            <span class="px-2.5 py-1 rounded-md text-[0.7rem] font-bold border {{ $class }} uppercase tracking-wide">
                                {{ $appraisal->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($appraisal->total_score)
                                <span class="font-black text-white">{{ $appraisal->total_score }}</span>
                            @else
                                <span class="text-slate-600">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('hr-manager.appraisals.edit', $appraisal) }}" class="px-3 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold transition-all shadow-lg shadow-indigo-500/20">
                                Review
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                            No appraisals found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($appraisals->hasPages())
            <div class="px-6 py-4 border-t border-white/5">
                {{ $appraisals->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
