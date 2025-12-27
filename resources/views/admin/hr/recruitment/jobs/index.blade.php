@extends('layouts.admin')

@section('header', 'Recruitment / Jobs')

@section('content')
<div class="container mx-auto">
    <!-- Actions -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-black text-slate-900 tracking-tight">Active Job Postings</h2>
        <a href="{{ route('hr-manager.recruitment.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-bold transition-all shadow-sm">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span class="text-sm uppercase tracking-widest">Create New Job</span>
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Job Title</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Type</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Applicants</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($jobs as $job)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900">{{ $job->title }}</div>
                            <div class="text-[10px] font-black uppercase tracking-widest text-slate-400">{{ $job->department->name ?? 'General' }} • {{ $job->location }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold text-slate-600 uppercase">{{ $job->employment_type }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'Draft' => 'bg-slate-100 text-slate-600',
                                    'Published' => 'bg-emerald-50 text-emerald-600 border border-emerald-100',
                                    'Closed' => 'bg-rose-50 text-rose-600 border border-rose-100',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded text-[10px] font-black uppercase tracking-widest {{ $statusClasses[$job->status] ?? '' }}">
                                {{ $job->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="bg-slate-100 text-slate-600 text-[10px] font-black px-2 py-1 rounded-lg border border-slate-200">
                                    {{ $job->applications_count }}
                                </span>
                                @if($job->applications_count > 0)
                                <a href="{{ route('hr-manager.applications.index', ['job_id' => $job->id]) }}" class="text-[10px] font-black uppercase tracking-widest text-purple-600 hover:text-purple-700 underline">View</a>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                             <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('careers.show', $job) }}" target="_blank" class="p-2 rounded-lg hover:bg-slate-50 text-slate-400 hover:text-purple-600 transition-colors border border-transparent hover:border-slate-200" title="View Public Page">
                                    <i data-lucide="external-link" class="w-4 h-4"></i>
                                </a>
                                <a href="{{ route('hr-manager.recruitment.edit', $job) }}" class="p-2 rounded-lg hover:bg-slate-50 text-slate-400 hover:text-slate-600 transition-colors border border-transparent hover:border-slate-200">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('hr-manager.recruitment.destroy', $job) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this job? Applications will also be deleted.')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 rounded-lg hover:bg-rose-50 text-slate-400 hover:text-rose-600 transition-colors border border-transparent hover:border-rose-200">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            No job postings found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($jobs->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
                {{ $jobs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
