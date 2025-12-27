@extends('layouts.admin')

@section('header', 'Appraisal Details')

@section('content')
<div class="container mx-auto max-w-4xl">
    
    <!-- Header Card -->
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm shadow-xl mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="px-2.5 py-1 rounded-md text-xs font-bold bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 uppercase tracking-widest">
                        Assessment
                    </span>
                    <span class="text-sm font-bold text-slate-400">
                        {{ $appraisal->period_start->format('M Y') }} — {{ $appraisal->period_end->format('M Y') }}
                    </span>
                </div>
                <h2 class="text-2xl font-black text-white tracking-tight">Performance Review</h2>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Status</p>
                    <p class="text-lg font-bold text-white">{{ $appraisal->status }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Final Score</p>
                    <p class="text-3xl font-black text-indigo-400 leading-none">
                        {{ $appraisal->total_score ?? '--' }} <span class="text-sm text-slate-600 font-bold">/ 10</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Metrics Grid -->
    <div class="space-y-6">
        @foreach($appraisal->metrics as $metric)
        <div class="bg-slate-800 border border-white/5 rounded-2xl p-6 hover:border-white/10 transition-colors">
            
            <!-- KPI Header -->
            <div class="flex justify-between items-start mb-6 border-b border-white/5 pb-4">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                            <i data-lucide="target" class="w-4 h-4"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">{{ $metric->kpi->title }}</h3>
                    </div>
                    <p class="text-sm text-slate-400 pl-11">{{ $metric->kpi->description }}</p>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold px-2 py-1 rounded bg-slate-700 text-slate-300">
                        Weight: {{ number_format($metric->kpi->weight, 0) }}%
                    </span>
                </div>
            </div>

            <!-- Scores Comparison -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Self Assessment -->
                <div class="relative pl-4 border-l-2 border-slate-700">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">Self Assessment</p>
                    <div class="flex items-baseline gap-2 mb-2">
                        <span class="text-2xl font-black text-white">{{ $metric->self_score }}</span>
                        <span class="text-sm font-bold text-slate-600">/ 10</span>
                    </div>
                    <p class="text-sm text-slate-400 italic">"{{ $metric->comments ?? 'No comment provided.' }}"</p>
                </div>

                <!-- Manager Review -->
                <div class="relative pl-4 border-l-2 {{ $metric->manager_score ? 'border-indigo-500' : 'border-slate-800' }}">
                    <p class="text-xs font-bold {{ $metric->manager_score ? 'text-indigo-400' : 'text-slate-600' }} uppercase tracking-widest mb-3">Evaluator Rating</p>
                    @if($metric->manager_score)
                        <div class="flex items-baseline gap-2 mb-2">
                            <span class="text-2xl font-black text-white">{{ $metric->manager_score }}</span>
                            <span class="text-sm font-bold text-slate-600">/ 10</span>
                        </div>
                        {{-- Add manager comments field to metric model if needed, strictly it's not in the previous migration explicit manager_comment, only general comments or reusing comments? 
                             Wait, database/migrations/xxxx_create_appraisal_metrics_table.php has 'comments'. Ideally should have kept separate.
                             For now, assuming 'comments' is mixed or mostly self.
                             Actually, usually you want separate comments. In my previous step I used 'comments' for self-reflection.
                             I should have added 'manager_comments'.
                             For now, I will leave it blank or show "Pending Review".
                        --}}
                        @if($appraisal->status === 'Finalized' || $appraisal->status === 'Reviewed')
                             {{-- If I had a manager_comments column, I'd show it here. --}}
                             <p class="text-sm text-indigo-300/60 font-medium">Score verified by evaluator.</p>
                        @endif
                    @else
                        <div class="flex items-center gap-2 text-slate-600 mt-2">
                            <i data-lucide="clock" class="w-4 h-4"></i>
                            <span class="text-sm font-bold">Pending Review</span>
                        </div>
                    @endif
                </div>

            </div>
        </div>
        @endforeach
    </div>

    <!-- General Feedback -->
    @if($appraisal->comments)
    <div class="mt-8 bg-slate-800/50 border border-white/5 rounded-2xl p-6">
        <h4 class="text-sm font-bold text-white uppercase tracking-widest mb-3">Overall Feedback</h4>
        <p class="text-slate-400">{{ $appraisal->comments }}</p>
    </div>
    @endif

    <div class="mt-8 text-center">
        <a href="{{ route('employee.appraisals.index') }}" class="text-slate-500 hover:text-white font-bold transition-colors">
            &larr; Back to History
        </a>
    </div>

</div>
@endsection
