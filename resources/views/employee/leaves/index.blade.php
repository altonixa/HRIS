@extends('layouts.admin')

@section('header', 'My Leave Requests')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-white mb-1">Leave Requests</h1>
        <p class="text-slate-400 text-sm">Track your leave history and pending approvals.</p>
    </div>
    <a href="{{ route('employee.leaves.create') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
        <i data-lucide="plus-circle" class="w-4 h-4"></i> Apply for Leave
    </a>
</div>

<!-- Active / Pending Requests -->
@if($activeLeaves->count() > 0)
<div class="mb-8">
    <h3 class="text-white font-semibold mb-4 flex items-center gap-2">
        <i data-lucide="loader" class="w-5 h-5 text-amber-400"></i> Active Requests
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($activeLeaves as $leave)
        <div class="bg-slate-800 rounded-xl border border-white/5 p-5 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10">
                <i data-lucide="calendar" class="w-24 h-24 text-white"></i>
            </div>
            
            <div class="flex justify-between items-start mb-4 relative z-10">
                <div>
                    <div class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">{{ $leave->leaveType->name }}</div>
                    <div class="text-xl font-bold text-white">{{ $leave->days_count }} Days</div>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                    {{ $leave->status === 'pending' ? 'bg-amber-500/10 text-amber-400' : '' }}
                    {{ $leave->status === 'approved' ? 'bg-emerald-500/10 text-emerald-400' : '' }}
                ">
                    {{ $leave->status }}
                </span>
            </div>
            
            <div class="space-y-2 relative z-10">
                <div class="flex items-center gap-2 text-slate-300 text-sm">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500"></i>
                    <span>{{ $leave->start_date->format('M d, Y') }} - {{ $leave->end_date->format('M d, Y') }}</span>
                </div>
                <div class="flex items-start gap-2 text-slate-400 text-sm">
                    <i data-lucide="file-text" class="w-4 h-4 text-slate-500 mt-0.5"></i>
                    <p class="line-clamp-2">{{ $leave->reason }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- History Table -->
<div class="bg-slate-800 rounded-xl border border-white/5 overflow-hidden">
    <div class="px-6 py-4 border-b border-white/5 font-semibold text-white">Leave History</div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-400">
            <thead class="bg-slate-900/50 text-xs uppercase font-semibold text-slate-300">
                <tr>
                    <th class="px-6 py-4">Type</th>
                    <th class="px-6 py-4">Duration</th>
                    <th class="px-6 py-4">Dates</th>
                    <th class="px-6 py-4">Applied On</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($history as $record)
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-white">{{ $record->leaveType->name }}</td>
                    <td class="px-6 py-4">{{ $record->days_count }} Days</td>
                    <td class="px-6 py-4">
                        {{ $record->start_date->format('M d') }} - {{ $record->end_date->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4">{{ $record->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium 
                            {{ $record->status === 'approved' ? 'bg-emerald-500/10 text-emerald-400' : '' }}
                            {{ $record->status === 'rejected' ? 'bg-rose-500/10 text-rose-400' : '' }}
                            {{ $record->status === 'pending' ? 'bg-amber-500/10 text-amber-400' : '' }}
                        ">
                            {{ ucfirst($record->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                        No leave history found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($history->hasPages())
    <div class="p-4 border-t border-white/5">
        {{ $history->links() }}
    </div>
    @endif
</div>
@endsection
