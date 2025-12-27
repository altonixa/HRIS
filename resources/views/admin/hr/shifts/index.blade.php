@extends('layouts.admin')

@section('header', 'Shift Schedules')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-white mb-1">Work Shifts</h1>
        <p class="text-slate-400 text-sm">Define working hours and grace periods.</p>
    </div>
    <a href="{{ route('hr-manager.shifts.create') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
        <i data-lucide="plus-circle" class="w-4 h-4"></i> Add New Shift
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($shifts as $shift)
    <div class="bg-slate-800 rounded-xl border border-white/5 p-6 relative group hover:border-indigo-500/50 transition-colors">
        <div class="flex justify-between items-start mb-4">
            <div class="w-10 h-10 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                <i data-lucide="clock" class="w-5 h-5"></i>
            </div>
            <form action="{{ route('hr-manager.shifts.destroy', $shift->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-slate-500 hover:text-rose-400 transition-colors">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
        
        <h3 class="text-lg font-bold text-white mb-1">{{ $shift->name }}</h3>
        <p class="text-slate-400 text-sm mb-4">{{ \Carbon\Carbon::parse($shift->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($shift->end_time)->format('h:i A') }}</p>
        
        <div class="flex items-center gap-2 text-xs font-medium text-slate-500 bg-slate-900/50 py-2 px-3 rounded-lg border border-white/5">
            <i data-lucide="alert-circle" class="w-3 h-3"></i>
            Grace Period: {{ $shift->grace_period_minutes }} mins
        </div>
    </div>
    @empty
    <div class="col-span-full py-12 text-center">
        <div class="w-16 h-16 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="clock" class="w-8 h-8 text-slate-600"></i>
        </div>
        <h3 class="text-white font-medium mb-1">No Shifts Found</h3>
        <p class="text-slate-500 text-sm">Create a shift to get started.</p>
    </div>
    @endforelse
</div>
@endsection
