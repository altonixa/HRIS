@extends('layouts.admin')

@section('header', 'Leave Management')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900 mb-1">Leave Requests</h1>
    <p class="text-slate-500 text-sm font-medium">Review, approve, or reject employee leave applications.</p>
</div>

<!-- Pending Requests -->
@if($pendingLeaves->count() > 0)
<div class="mb-8">
    <h3 class="text-slate-900 font-black uppercase tracking-widest text-xs mb-4 flex items-center gap-2">
        <div class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></div>
        Pending Approvals
    </h3>
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
        @foreach($pendingLeaves as $leave)
        <div class="bg-white rounded-xl border border-slate-200 p-5 relative overflow-hidden group hover:border-purple-600/30 transition-all shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 font-black text-sm border border-slate-200 shadow-sm">
                        {{ substr($leave->employee->first_name, 0, 1) }}{{ substr($leave->employee->last_name, 0, 1) }}
                    </div>
                    <div>
                        <div class="text-slate-900 font-bold text-sm">{{ $leave->employee->first_name }} {{ $leave->employee->last_name }}</div>
                        <div class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ $leave->employee->designation->title ?? 'Employee' }}</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-slate-900 font-black text-lg tracking-tighter">{{ $leave->days_count }} Days</div>
                    <div class="text-[10px] text-purple-600 font-black uppercase tracking-widest">{{ $leave->leaveType->name }}</div>
                </div>
            </div>
            
            <div class="bg-slate-50 rounded-xl p-3 mb-4 border border-slate-200">
                <div class="flex items-center gap-2 text-slate-600 text-xs font-bold mb-2">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i>
                    <span>{{ $leave->start_date->format('M d') }} - {{ $leave->end_date->format('M d, Y') }}</span>
                </div>
                <p class="text-slate-500 text-sm italic font-medium">"{{ $leave->reason }}"</p>
            </div>
            
            <div class="flex gap-2">
                <form action="{{ route('hr-manager.leaves.update', $leave->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="w-full bg-slate-50 hover:bg-rose-50 hover:text-rose-600 text-slate-500 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all border border-slate-200 hover:border-rose-200">
                        Reject
                    </button>
                </form>
                <form action="{{ route('hr-manager.leaves.update', $leave->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-sm">
                        Approve Request
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- History Table -->
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
    <div class="px-6 py-4 border-b border-slate-100 font-black uppercase tracking-widest text-xs text-slate-900">Approval History</div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600 border-collapse">
            <thead class="bg-slate-50 text-[10px] uppercase font-black tracking-widest text-slate-400">
                <tr class="border-b border-slate-200">
                    <th class="px-6 py-4">Employee</th>
                    <th class="px-6 py-4">Type</th>
                    <th class="px-6 py-4">Dates</th>
                    <th class="px-6 py-4">Approved By</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($history as $record)
                <tr class="hover:bg-slate-50 transition-all">
                    <td class="px-6 py-4 text-slate-900 font-bold">
                        {{ $record->employee->first_name }} {{ $record->employee->last_name }}
                    </td>
                    <td class="px-6 py-4 font-medium italic text-xs text-slate-500">{{ $record->leaveType->name }} ({{ $record->days_count }} Days)</td>
                    <td class="px-6 py-4 text-xs font-bold text-slate-600">
                        {{ $record->start_date->format('M d') }} - {{ $record->end_date->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 text-[10px] uppercase font-black tracking-widest">
                        {{ $record->approver->name ?? 'System' }}<br>
                        <span class="text-slate-400">{{ $record->approved_at ? $record->approved_at->format('M d, H:i') : '-' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest border
                            {{ $record->status === 'approved' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : '' }}
                            {{ $record->status === 'rejected' ? 'bg-rose-50 text-rose-600 border-rose-100' : '' }}
                        ">
                            {{ ucfirst($record->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                        No processing history found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($history->hasPages())
    <div class="p-4 border-t border-slate-100 bg-slate-50">
        {{ $history->links() }}
    </div>
    @endif
</div>
@endsection
