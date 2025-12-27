@extends('layouts.admin')

@section('header', 'New Self-Appraisal')

@section('content')
<div class="container mx-auto max-w-4xl">
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm shadow-xl">
        <form action="{{ route('employee.appraisals.store') }}" method="POST">
            @csrf
            
            <!-- Header / Period -->
            <div class="p-6 border-b border-white/5 bg-slate-900/50">
                <div class="flex flex-col md:flex-row gap-6 mb-4">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Assessment Period</label>
                        <div class="flex items-center gap-4">
                            <div class="relative flex-1">
                                <span class="absolute left-3 top-2.5 text-slate-500"><i data-lucide="calendar" class="w-4 h-4"></i></span>
                                <input type="date" name="period_start" required class="w-full pl-10 bg-slate-800 border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                            <span class="text-slate-500 font-bold">TO</span>
                            <div class="relative flex-1">
                                <span class="absolute left-3 top-2.5 text-slate-500"><i data-lucide="calendar" class="w-4 h-4"></i></span>
                                <input type="date" name="period_end" required class="w-full pl-10 bg-slate-800 border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KPIs -->
            <div class="p-6 space-y-8">
                <h3 class="text-lg font-black text-white tracking-tight flex items-center gap-2">
                    <i data-lucide="list-checks" class="text-indigo-400"></i> Performance Indicators
                </h3>

                @foreach($kpis as $kpi)
                <div class="bg-slate-800 border border-white/5 rounded-xl p-5 hover:border-indigo-500/30 transition-colors">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <h4 class="font-bold text-white text-md">{{ $kpi->title }}</h4>
                                <span class="text-xs font-bold px-2 py-0.5 rounded bg-indigo-500/10 text-indigo-400">{{ number_format($kpi->weight, 0) }}% Weight</span>
                            </div>
                            <p class="text-sm text-slate-400">{{ $kpi->description }}</p>
                            @if($kpi->target_value)
                                <p class="text-xs text-slate-500 mt-1 font-mono">Target: {{ $kpi->target_value }} {{ $kpi->unit }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                        <!-- Rating -->
                        <div class="md:col-span-4">
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Your Rating (0-10)</label>
                            <div class="flex items-center gap-3">
                                <input type="number" name="ratings[{{ $kpi->id }}]" min="0" max="10" step="0.1" required 
                                    class="w-full bg-slate-900 border-white/10 rounded-lg px-3 py-2 text-white font-bold focus:ring-2 focus:ring-indigo-500 text-center"
                                    placeholder="Score">
                                <span class="text-slate-600 font-bold text-sm">/ 10</span>
                            </div>
                        </div>

                        <!-- Comment -->
                        <div class="md:col-span-8">
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Self-Reflection / Evidence</label>
                            <input type="text" name="comments[{{ $kpi->id }}]" 
                                class="w-full bg-slate-900 border-white/10 rounded-lg px-3 py-2 text-white focus:ring-2 focus:ring-indigo-500 placeholder-slate-600"
                                placeholder="Describe your achievements regarding this KPI...">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- General Comments -->
            <div class="p-6 border-t border-white/5 bg-slate-900/30">
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Overall Remarks</label>
                <textarea name="general_comments" rows="3" class="w-full bg-slate-800 border-white/10 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-indigo-500 placeholder-slate-600" placeholder="Any additional context for this period..."></textarea>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-slate-900 border-t border-white/5 flex items-center justify-end gap-3">
                <a href="{{ route('employee.appraisals.index') }}" class="px-4 py-2 rounded-lg text-slate-400 hover:text-white font-bold transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg font-bold transition-colors shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    Submit Self-Appraisal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
