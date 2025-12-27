@extends('layouts.admin')

@section('header', 'Applicant Tracking')

@section('content')
<div class="container mx-auto">
    <!-- Filters -->
    <div class="mb-6 flex space-x-2 overflow-x-auto pb-2 scrollbar-none">
        <a href="{{ route('hr-manager.applications.index') }}" class="px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-widest {{ !request('status') ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-500 hover:text-slate-900 border border-slate-200' }} transition-all whitespace-nowrap">
            All Applications
        </a>
        @foreach(['New', 'Screening', 'Interview', 'Offered', 'Hired', 'Rejected'] as $status)
        <a href="{{ route('hr-manager.applications.index', ['status' => $status]) }}" class="px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-widest {{ request('status') == $status ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-500 hover:text-slate-900 border border-slate-200' }} transition-all whitespace-nowrap">
            {{ $status }}
        </a>
        @endforeach
    </div>

    <!-- Table -->
    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Candidate</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Applied Position</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Applied Date</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($applications as $app)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-[10px] font-black text-slate-600 border border-slate-200 shadow-sm transition-transform group-hover:scale-110">
                                    {{ substr($app->full_name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 text-sm">{{ $app->full_name }}</div>
                                    <div class="text-[10px] font-black uppercase tracking-widest text-slate-400">{{ $app->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-[10px] font-black uppercase tracking-widest text-purple-600 bg-purple-50 px-2 py-1 rounded border border-purple-100">{{ $app->jobPosting->title }}</span>
                        </td>
                        <td class="px-6 py-4">
                             <div class="text-[10px] font-black uppercase tracking-widest text-slate-600">{{ $app->created_at->format('M d, Y') }}</div>
                             <div class="text-[0.65rem] text-slate-400 font-medium">{{ $app->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $colors = [
                                    'New' => 'bg-blue-50 text-blue-600 border-blue-100',
                                    'Screening' => 'bg-amber-50 text-amber-600 border-amber-100',
                                    'Interview' => 'bg-purple-50 text-purple-600 border-purple-100',
                                    'Offered' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                    'Hired' => 'bg-green-50 text-green-600 border-green-100',
                                    'Rejected' => 'bg-rose-50 text-rose-600 border-rose-100',
                                ];
                                $color = $colors[$app->status] ?? 'bg-slate-100 text-slate-600 border-slate-200';
                            @endphp
                            <span class="px-2.5 py-1 rounded text-[0.7rem] font-black border {{ $color }} uppercase tracking-widest">
                                {{ $app->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('hr-manager.applications.show', $app) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-[10px] font-black uppercase tracking-widest transition-all shadow-sm">
                                View Profile
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            No applications found matching criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($applications->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
