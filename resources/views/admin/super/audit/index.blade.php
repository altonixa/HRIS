@extends('layouts.admin')

@section('header', 'Audit Logs')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-white mb-1">System Audit Logs</h1>
        <p class="text-slate-400 text-sm">Immutable record of all system activities.</p>
    </div>
    <div class="flex gap-2">
        <button class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-3 py-1.5 rounded-lg border border-white/5 text-xs font-medium transition-colors flex items-center gap-2">
            <i data-lucide="filter" class="w-3 h-3"></i> Filter
        </button>
        <button class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-3 py-1.5 rounded-lg border border-white/5 text-xs font-medium transition-colors flex items-center gap-2">
            <i data-lucide="download" class="w-3 h-3"></i> Export CSV
        </button>
    </div>
</div>

<div class="bg-slate-800 rounded-xl border border-white/5 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-400">
            <thead class="bg-slate-900/50 text-xs uppercase font-semibold text-slate-300">
                <tr>
                    <th class="px-6 py-4">User</th>
                    <th class="px-6 py-4">Action</th>
                    <th class="px-6 py-4">Target</th>
                    <th class="px-6 py-4">IP Address</th>
                    <th class="px-6 py-4">Time</th>
                    <th class="px-6 py-4 text-right">Details</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($logs as $log)
                <tr class="hover:bg-white/5 transition-colors font-mono text-xs">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded bg-slate-700 flex items-center justify-center text-white font-bold">{{ substr($log->user->name ?? '?', 0, 1) }}</span>
                            <span class="text-slate-300">{{ $log->user->name ?? 'System' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 rounded text-[10px] uppercase font-bold bg-blue-500/10 text-blue-400">
                            {{ $log->event }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-300">
                        {{ class_basename($log->auditable_type) }} #{{ $log->auditable_id }}
                    </td>
                    <td class="px-6 py-4 text-slate-500">
                        {{ $log->ip_address }}
                    </td>
                    <td class="px-6 py-4 text-slate-400">
                        {{ $log->created_at->format('Y-m-d H:i:s') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-slate-500 hover:text-white transition-colors" title="View Details">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                        No audit records found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($logs->hasPages())
    <div class="p-4 border-t border-white/5">
        {{ $logs->links() }}
    </div>
    @endif
</div>
@endsection
