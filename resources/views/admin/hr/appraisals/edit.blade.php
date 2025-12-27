@extends('layouts.admin')

@section('header', 'Review Appraisal')

@section('content')
<div class="container mx-auto max-w-4xl">
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm shadow-xl">
        <form action="{{ route('hr-manager.appraisals.update', $appraisal) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Employee Header -->
            <div class="p-6 border-b border-white/5 bg-slate-900/50">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-slate-700 overflow-hidden border-2 border-white/10">
                         @if($appraisal->employee->profile_picture)
                            <img src="{{ Storage::url($appraisal->employee->profile_picture) }}" class="w-full h-full object-cover">
                         @else
                            <div class="w-full h-full flex items-center justify-center text-xl font-bold text-white">
                                {{ substr($appraisal->employee->first_name, 0, 1) }}
                            </div>
                         @endif
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-white">{{ $appraisal->employee->first_name }} {{ $appraisal->employee->last_name }}</h2>
                        <p class="text-slate-400 font-medium">{{ $appraisal->employee->designation->name ?? 'Employee' }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs font-bold px-2 py-0.5 rounded bg-slate-700 text-slate-300 uppercase tracking-wide">
                                {{ $appraisal->period_start->format('M Y') }} - {{ $appraisal->period_end->format('M Y') }}
                            </span>
                             <span class="text-xs font-bold px-2 py-0.5 rounded bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 uppercase tracking-wide">
                                {{ $appraisal->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metrics Review -->
            <div class="p-6 space-y-8">
                @foreach($appraisal->metrics as $metric)
                <div class="bg-slate-800 border border-white/5 rounded-xl p-5 hover:border-indigo-500/30 transition-colors">
                    
                    <!-- KPI Info -->
                    <div class="flex justify-between items-start mb-6 pb-4 border-b border-white/5">
                        <div>
                            <h4 class="font-bold text-white text-lg mb-1">{{ $metric->kpi->title }}</h4>
                            <p class="text-sm text-slate-400">{{ $metric->kpi->description }}</p>
                        </div>
                        <span class="text-xs font-bold px-2 py-1 rounded bg-slate-700 text-slate-300 whitespace-nowrap">
                            Weight: {{ number_format($metric->kpi->weight, 0) }}%
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Employee Side -->
                        <div class="relative pl-4 border-l-2 border-slate-700">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">Employee Self-Rating</p>
                            <div class="flex items-baseline gap-2 mb-2">
                                <span class="text-2xl font-black text-white">{{ $metric->self_score }}</span>
                                <span class="text-sm font-bold text-slate-600">/ 10</span>
                            </div>
                            <p class="text-sm text-slate-400 italic">"{{ $metric->comments ?? 'No notes provided.' }}"</p>
                        </div>

                        <!-- Manager Side -->
                        <div class="relative pl-4 border-l-2 border-indigo-500">
                            <p class="text-xs font-bold text-indigo-400 uppercase tracking-widest mb-3">Your Assessment</p>
                            <label class="block text-xs font-bold text-slate-400 mb-1">Score (0-10)</label>
                            <input type="number" name="manager_ratings[{{ $metric->id }}]" 
                                value="{{ $metric->manager_score ?? $metric->self_score }}" 
                                min="0" max="10" step="0.1" required 
                                class="w-full bg-slate-900 border-white/10 rounded-lg px-3 py-2 text-white font-bold focus:ring-2 focus:ring-indigo-500 text-center text-lg mb-2">
                            
                            <!-- Optional Manager Comment could go here -->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Summary -->
            <div class="p-6 border-t border-white/5 bg-slate-900/30">
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Final Remarks</label>
                <textarea name="final_comments" rows="3" class="w-full bg-slate-800 border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 placeholder-slate-600" placeholder="Summary of performance...">{{ $appraisal->comments }}</textarea>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-slate-900 border-t border-white/5 flex items-center justify-between">
                <a href="{{ route('hr-manager.appraisals.index') }}" class="px-4 py-2 rounded-lg text-slate-400 hover:text-white font-bold transition-colors">Cancel</a>
                
                <div class="flex items-center gap-3">
                    <button type="submit" name="action" value="save" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-white font-bold transition-colors border border-white/10">
                        Save Draft
                    </button>
                    <button type="submit" name="action" value="finalize" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg font-bold transition-colors shadow-lg shadow-indigo-500/20 flex items-center gap-2" onclick="return confirm('Finalize this appraisal? This will calculate the final score and lock the review.')">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        Finalize Review
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
