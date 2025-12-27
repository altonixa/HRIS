@extends('layouts.admin')

@section('header', 'My Assigned Equipment')

@section('content')
<div class="space-y-8">
    <div class="bg-indigo-600 rounded-[40px] p-10 shadow-2xl shadow-indigo-600/20 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-8 opacity-10 transform scale-150 rotate-12 group-hover:rotate-0 transition-transform duration-700">
            <i data-lucide="shield-check" class="w-32 h-32 text-white"></i>
        </div>
        <div class="relative z-10">
            <h2 class="text-3xl font-black text-white tracking-tighter mb-2 italic">Corporate Governance</h2>
            <p class="text-indigo-100 text-sm font-bold uppercase tracking-widest max-w-md">You are responsible for the following company assets. Please notify IT immediately if any equipment is damaged or stolen.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($assignments as $assign)
        <div class="bg-slate-900 border border-white/5 rounded-[40px] p-8 hover:border-indigo-500/30 transition-all group relative overflow-hidden shadow-xl">
            <div class="absolute -top-4 -right-4 w-24 h-24 bg-indigo-500/5 rounded-full blur-2xl"></div>
            
            <div class="flex items-center justify-between mb-8">
                <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center text-indigo-400 group-hover:scale-110 transition-transform shadow-inner">
                    <i data-lucide="{{ str_contains(strtolower($assign->asset->category), 'laptop') ? 'laptop' : (str_contains(strtolower($assign->asset->category), 'phone') ? 'smartphone' : 'package') }}" class="w-7 h-7"></i>
                </div>
                <div class="text-[10px] font-black text-slate-600 uppercase tracking-widest bg-white/5 px-4 py-1.5 rounded-full border border-white/5">
                    {{ $assign->asset->asset_code }}
                </div>
            </div>

            <h3 class="text-xl font-black text-white mb-1 group-hover:text-indigo-400 transition-colors">{{ $assign->asset->name }}</h3>
            <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-6">{{ $assign->asset->category }}</p>

            <div class="space-y-4 pt-6 border-t border-white/5">
                <div class="flex justify-between items-center text-[11px] font-bold">
                    <span class="text-slate-500 uppercase tracking-tighter">Assigned Date</span>
                    <span class="text-white italic">{{ $assign->assigned_date->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between items-center text-[11px] font-bold">
                    <span class="text-slate-500 uppercase tracking-tighter">Condition</span>
                    <span class="badge badge-primary text-[8px] font-black px-2 uppercase">{{ $assign->condition_on_assign }}</span>
                </div>
                @if($assign->asset->serial_number)
                <div class="flex justify-between items-center text-[11px] font-bold">
                    <span class="text-slate-500 uppercase tracking-tighter">S/N</span>
                    <span class="text-slate-300 font-mono">{{ $assign->asset->serial_number }}</span>
                </div>
                @endif
            </div>

            <div class="mt-8 pt-8 border-t border-white/5 flex gap-3">
                <button class="flex-1 py-3 bg-white/5 hover:bg-rose-500/10 hover:text-rose-500 text-slate-400 text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all border border-transparent hover:border-rose-500/20">
                    Report Issue
                </button>
            </div>
        </div>
        @empty
        <div class="col-span-full py-24 text-center bg-slate-900/10 border border-dashed border-white/5 rounded-[60px]">
            <div class="w-20 h-20 bg-slate-900 rounded-[32px] flex items-center justify-center text-slate-700 mx-auto mb-6 border border-white/5">
                <i data-lucide="inbox" class="w-10 h-10"></i>
            </div>
            <h3 class="text-slate-400 font-bold text-lg mb-2 italic">Zero Assets Assigned</h3>
            <p class="text-slate-600 text-xs font-bold uppercase tracking-widest">Your inventory is currently clear.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
