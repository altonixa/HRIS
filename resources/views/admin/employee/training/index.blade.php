@extends('layouts.admin')

@section('header', 'My Learning Journey')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-black text-white tracking-tighter mb-2">Knowledge Matrix</h1>
    <p class="text-slate-500 text-sm font-bold uppercase tracking-widest">Growth & Professional Excellence Certification Path</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
    @forelse($trainings as $training)
    <div class="bg-slate-900 border border-white/5 rounded-[40px] p-8 relative overflow-hidden group">
        <!-- Status Specific Gradient Overlay -->
        <div class="absolute top-0 right-0 p-12 opacity-5 pointer-events-none">
            <i data-lucide="{{ $training->status === 'completed' ? 'check-circle' : 'play-circle' }}" class="w-32 h-32"></i>
        </div>

        <div class="flex items-center justify-between mb-8">
            <div class="w-12 h-12 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-400">
                <i data-lucide="book" class="w-6 h-6"></i>
            </div>
            <span class="badge {{ $training->status === 'completed' ? 'badge-success' : 'badge-primary' }} text-[9px] font-black tracking-widest px-3 py-1">
                {{ strtoupper(str_replace('_', ' ', $training->status)) }}
            </span>
        </div>

        <h3 class="text-xl font-black text-white mb-2 leading-tight">{{ $training->course->title }}</h3>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mb-6">CODE: {{ $training->course->code }}</p>

        <div class="space-y-4 mb-8">
            <div class="flex items-center justify-between text-xs font-bold uppercase tracking-tighter">
                <span class="text-slate-500">Milestone Progress</span>
                <span class="text-white">{{ $training->status === 'completed' ? '100%' : 'Assigned' }}</span>
            </div>
            <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                <div class="h-full {{ $training->status === 'completed' ? 'bg-emerald-500' : 'bg-indigo-500' }}" style="width: {{ $training->status === 'completed' ? '100%' : '15%' }}"></div>
            </div>
        </div>

        <div class="flex items-center gap-6 text-[10px] font-black uppercase tracking-widest text-slate-500 pt-6 border-t border-white/5">
            <div class="flex items-center gap-1.5">
                <i data-lucide="calendar" class="w-3 h-3"></i> 
                {{ $training->completion_date ? $training->completion_date->format('M Y') : 'Ongoing' }}
            </div>
            @if($training->score)
            <div class="flex items-center gap-1.5 text-emerald-400">
                <i data-lucide="award" class="w-3 h-3"></i> 
                Score: {{ $training->score }}%
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="col-span-full py-24 text-center bg-slate-900/30 border border-dashed border-white/10 rounded-[40px]">
        <div class="w-20 h-20 bg-slate-800 rounded-[32px] flex items-center justify-center text-slate-600 mx-auto mb-6">
            <i data-lucide="book-open" class="w-10 h-10"></i>
        </div>
        <h3 class="text-white font-bold mb-2">Your learning queue is currently empty.</h3>
        <p class="text-slate-500 text-sm">New professional development paths will appear here once assigned.</p>
    </div>
    @endforelse
</div>

<!-- Global Learning Progress Visualization (Placeholder for Phase 11) -->
<div class="bg-indigo-600/10 border border-indigo-500/20 rounded-[40px] p-10 flex flex-col md:flex-row items-center gap-10">
    <div class="flex-1">
        <h3 class="text-2xl font-black text-white tracking-tighter mb-4 leading-tight">Beyond the classroom. Build your expertise profile.</h3>
        <p class="text-slate-400 text-sm leading-relaxed mb-8">Every completed certification adds points to your quarterly performance review. Your growth is directly tied to your organizational trajectory.</p>
        <button class="px-8 py-3 bg-indigo-600 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-indigo-500 transition-all shadow-xl shadow-indigo-600/30">request new certification</button>
    </div>
    <div class="w-full md:w-64 aspect-square bg-slate-900/50 rounded-full border border-white/5 flex items-center justify-center relative overflow-hidden">
        <div class="text-center">
            <div class="text-4xl font-black text-white">{{ $trainings->where('status', 'completed')->count() }}</div>
            <div class="text-[10px] text-indigo-400 font-bold uppercase tracking-widest mt-1">Certs Earnt</div>
        </div>
        <!-- Progress circle mock -->
        <svg class="absolute inset-0 w-full h-full -rotate-90">
            <circle cx="50%" cy="50%" r="48%" stroke="rgba(79, 70, 229, 0.1)" stroke-width="8" fill="transparent" />
            <circle cx="50%" cy="50%" r="48%" stroke="var(--primary)" stroke-width="8" fill="transparent" stroke-dasharray="300" stroke-dashoffset="100" />
        </svg>
    </div>
</div>
@endsection
