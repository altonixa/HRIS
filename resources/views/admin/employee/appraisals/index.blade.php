@extends('layouts.admin')

@section('header', 'My Appraisals')

@section('content')
<div class="container mx-auto">
    
    <!-- Header / Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-indigo-500/10 border border-indigo-500/20 rounded-2xl p-6 backdrop-blur-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-500/20 flex items-center justify-center text-indigo-400">
                    <i data-lucide="award" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-indigo-400 uppercase tracking-widest">Completed</p>
                    <p class="text-2xl font-black text-white">{{ $appraisals->where('status', 'Finalized')->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-amber-500/10 border border-amber-500/20 rounded-2xl p-6 backdrop-blur-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-500/20 flex items-center justify-center text-amber-400">
                    <i data-lucide="clock" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-amber-400 uppercase tracking-widest">Pending Review</p>
                    <p class="text-2xl font-black text-white">{{ $appraisals->where('status', 'Submitted')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Layout -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-black text-white tracking-tight">Appraisal History</h2>
        <a href="{{ route('employee.appraisals.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-bold transition-all shadow-lg shadow-indigo-500/20">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>New Self-Appraisal</span>
        </a>
    </div>

    <!-- List -->
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 border-b border-white/5">
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Period</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Evaluator</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest">Score</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($appraisals as $appraisal)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-slate-700/50 border border-white/5 flex flex-col items-center justify-center">
                                    <span class="text-[0.6rem] font-bold text-slate-400 uppercase">{{ $appraisal->period_end->format('M') }}</span>
                                    <span class="text-sm font-black text-white leading-none">{{ $appraisal->period_end->format('d') }}</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-white">{{ $appraisal->period_start->format('M Y') }} - {{ $appraisal->period_end->format('M Y') }}</p>
                                    <p class="text-xs text-slate-500">{{ $appraisal->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
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
                            @if($appraisal->evaluator)
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-indigo-500/20 flex items-center justify-center text-xs font-bold text-indigo-400">
                                    {{ substr($appraisal->evaluator->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-medium text-slate-300">{{ $appraisal->evaluator->name }}</span>
                            </div>
                            @else
                                <span class="text-xs text-slate-500 italic">Pending assignment</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($appraisal->total_score)
                                <span class="text-lg font-black text-white">{{ $appraisal->total_score }}</span>
                                <span class="text-xs text-slate-500">/ 10</span>
                            @else
                                <span class="text-slate-600">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('employee.appraisals.show', $appraisal) }}" class="p-2 inline-flex rounded-lg hover:bg-white/10 text-slate-400 hover:text-white transition-colors">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="w-16 h-16 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="clipboard-list" class="w-8 h-8 text-slate-600"></i>
                            </div>
                            <h3 class="text-white font-bold mb-1">No Appraisals Yet</h3>
                            <p class="text-slate-500 text-sm mb-4">You haven't submitted any self-assessments.</p>
                            <a href="{{ route('employee.appraisals.create') }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-bold">Start your first appraisal &rarr;</a>
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
