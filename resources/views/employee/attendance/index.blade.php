@extends('layouts.admin')

@section('header', 'My Attendance')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Clock In/Out Card -->
    <div class="md:col-span-1">
        <div class="bg-slate-800 rounded-xl border border-white/5 p-6 text-center h-full flex flex-col justify-center items-center relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            
            <div class="text-slate-400 text-sm font-medium uppercase mb-1">{{ date('l, F j, Y') }}</div>
            <div class="text-3xl font-bold text-white mb-6 font-mono" id="clock">00:00:00</div>

            @if(!$todayLog)
                <form action="{{ route('employee.attendance.clock-in') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-40 h-40 rounded-full bg-emerald-500/10 border-4 border-emerald-500 text-emerald-400 hover:bg-emerald-500 hover:text-white transition-all duration-300 flex flex-col items-center justify-center gap-2 shadow-[0_0_30px_rgba(16,185,129,0.2)] hover:shadow-[0_0_50px_rgba(16,185,129,0.4)]">
                        <i data-lucide="log-in" class="w-10 h-10"></i>
                        <span class="font-bold text-lg">Clock In</span>
                    </button>
                    <p class="mt-4 text-emerald-400/80 text-sm">Good morning! Ready to start?</p>
                </form>
            @elseif(!$todayLog->clock_out)
                <form action="{{ route('employee.attendance.clock-out') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-40 h-40 rounded-full bg-rose-500/10 border-4 border-rose-500 text-rose-400 hover:bg-rose-500 hover:text-white transition-all duration-300 flex flex-col items-center justify-center gap-2 shadow-[0_0_30px_rgba(244,63,94,0.2)] hover:shadow-[0_0_50px_rgba(244,63,94,0.4)]">
                        <i data-lucide="log-out" class="w-10 h-10"></i>
                        <span class="font-bold text-lg">Clock Out</span>
                    </button>
                    <div class="mt-4 text-slate-400 text-sm">
                        Clocked in at <strong class="text-white">{{ \Carbon\Carbon::parse($todayLog->clock_in)->format('H:i A') }}</strong>
                    </div>
                </form>
            @else
                <div class="w-40 h-40 rounded-full bg-slate-700/50 border-4 border-slate-600 flex flex-col items-center justify-center text-slate-400">
                    <i data-lucide="check-circle" class="w-10 h-10 mb-2"></i>
                    <span class="font-bold">Completed</span>
                </div>
                <div class="mt-4 text-slate-400 text-sm">
                    Worked: <strong class="text-white">
                        {{ \Carbon\Carbon::parse($todayLog->clock_in)->diffInHours(\Carbon\Carbon::parse($todayLog->clock_out)) }} hrs
                    </strong>
                </div>
            @endif
        </div>
    </div>

    <!-- Stats / Summary -->
    <div class="md:col-span-2 grid grid-cols-2 gap-4">
        <div class="bg-slate-800 p-6 rounded-xl border border-white/5">
            <div class="text-slate-400 text-xs font-semibold uppercase mb-2">This Month</div>
            <div class="flex items-end gap-2">
                <div class="text-3xl font-bold text-white">
                    {{ $logs->where('status', 'present')->count() }}
                </div>
                <div class="text-sm text-slate-500 mb-1">Days Present</div>
            </div>
        </div>
        <div class="bg-slate-800 p-6 rounded-xl border border-white/5">
            <div class="text-slate-400 text-xs font-semibold uppercase mb-2">Late Arrivals</div>
            <div class="flex items-end gap-2">
                <div class="text-3xl font-bold text-amber-400">
                    {{ $logs->where('status', 'late')->count() }}
                </div>
                <div class="text-sm text-slate-500 mb-1">Days</div>
            </div>
        </div>
        <!-- Recent Logs Table -->
        <div class="col-span-2 bg-slate-800 rounded-xl border border-white/5 overflow-hidden">
            <div class="px-6 py-4 border-b border-white/5 font-semibold text-white">Recent Activity</div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-400">
                    <thead class="bg-slate-900/50 text-xs uppercase font-semibold text-slate-300">
                        <tr>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Clock In</th>
                            <th class="px-6 py-3">Clock Out</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($logs as $log)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-3">{{ $log->date->format('M d, Y') }}</td>
                            <td class="px-6 py-3 text-white">{{ $log->clock_in ? \Carbon\Carbon::parse($log->clock_in)->format('H:i A') : '-' }}</td>
                            <td class="px-6 py-3 text-white">{{ $log->clock_out ? \Carbon\Carbon::parse($log->clock_out)->format('H:i A') : '-' }}</td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium 
                                    {{ $log->status === 'present' ? 'bg-emerald-500/10 text-emerald-400' : '' }}
                                    {{ $log->status === 'late' ? 'bg-amber-500/10 text-amber-400' : '' }}
                                    {{ $log->status === 'absent' ? 'bg-rose-500/10 text-rose-400' : '' }}
                                ">
                                    {{ ucfirst($log->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-slate-500">No attendance records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').innerText = now.toLocaleTimeString('en-US', { hour12: false });
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
@endsection
