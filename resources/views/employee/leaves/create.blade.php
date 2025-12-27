@extends('layouts.admin')

@section('header', 'Apply for Leave')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('employee.leaves.index') }}" class="text-slate-400 hover:text-white text-sm flex items-center gap-1 mb-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to History
        </a>
        <h1 class="text-2xl font-bold text-white">New Leave Request</h1>
        <p class="text-slate-400 text-sm">Submit a new request for time off.</p>
    </div>

    <div class="bg-slate-800 rounded-xl border border-white/5 p-6">
        <form action="{{ route('employee.leaves.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Leave Type</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($leaveTypes as $type)
                    <label class="cursor-pointer relative">
                        <input type="radio" name="leave_type_id" value="{{ $type->id }}" class="peer sr-only" required>
                        <div class="p-4 rounded-lg border border-slate-700 bg-slate-900 peer-checked:border-primary peer-checked:bg-primary/10 transition-all">
                            <div class="font-semibold text-white mb-1">{{ $type->name }}</div>
                            <div class="text-xs text-slate-400">{{ $type->days_allowed }} days/year</div>
                        </div>
                        <div class="absolute top-4 right-4 text-primary opacity-0 peer-checked:opacity-100 transition-opacity">
                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Start Date</label>
                    <input type="date" name="start_date" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">End Date</label>
                    <input type="date" name="end_date" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                </div>
            </div>
            
            <div>
                <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Reason</label>
                <textarea name="reason" rows="4" placeholder="Briefly explain the reason for your leave..." class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors" required></textarea>
            </div>
            
            <div class="flex justify-end pt-4 border-t border-white/5">
                <a href="{{ route('employee.leaves.index') }}" class="px-6 py-2.5 rounded-lg text-slate-400 hover:text-white font-medium transition-colors mr-3">Cancel</a>
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-lg font-medium shadow-lg shadow-primary/25 transition-all flex items-center gap-2">
                    <i data-lucide="send" class="w-4 h-4"></i> Submit Request
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
