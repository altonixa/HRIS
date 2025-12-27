@extends('layouts.admin')

@section('header', 'Create Shift')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('hr-manager.shifts.index') }}" class="text-slate-400 hover:text-white text-sm flex items-center gap-1 mb-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Shifts
        </a>
        <h1 class="text-2xl font-bold text-white">New Shift Schedule</h1>
        <p class="text-slate-400 text-sm">Define a new work timing pattern.</p>
    </div>

    <div class="bg-slate-800 rounded-xl border border-white/5 p-6">
        <form action="{{ route('hr-manager.shifts.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Shift Name</label>
                <input type="text" name="name" placeholder="e.g. Morning Shift" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Start Time</label>
                    <input type="time" name="start_time" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">End Time</label>
                    <input type="time" name="end_time" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                </div>
            </div>
            
            <div>
                <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Grace Period (Minutes)</label>
                <input type="number" name="grace_period_minutes" value="15" min="0" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                <p class="text-xs text-slate-500 mt-1">Allowed late duration before marking as "Late".</p>
            </div>
            
            <div class="flex justify-end pt-4 border-t border-white/5">
                <a href="{{ route('hr-manager.shifts.index') }}" class="px-6 py-2.5 rounded-lg text-slate-400 hover:text-white font-medium transition-colors mr-3">Cancel</a>
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-lg font-medium shadow-lg shadow-primary/25 transition-all">
                    Create Shift
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
