@extends('layouts.admin')

@section('header', 'Applicant Profile')

@section('content')
<div class="container mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Applicant Info -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm shadow-xl text-center">
                <div class="w-24 h-24 bg-slate-700 rounded-full mx-auto mb-4 flex items-center justify-center text-3xl font-bold text-white border-4 border-slate-600">
                    {{ substr($application->full_name, 0, 1) }}
                </div>
                <h2 class="text-xl font-black text-white mb-1">{{ $application->full_name }}</h2>
                <span class="text-sm font-medium text-indigo-400 bg-indigo-500/10 px-3 py-1 rounded-full border border-indigo-500/20">
                    {{ $application->jobPosting->title }}
                </span>

                <div class="mt-8 space-y-4 text-left">
                    <div class="flex items-center gap-3 text-slate-300">
                        <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm truncate" title="{{ $application->email }}">{{ $application->email }}</span>
                    </div>
                    @if($application->phone)
                    <div class="flex items-center gap-3 text-slate-300">
                         <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm">{{ $application->phone }}</span>
                    </div>
                    @endif
                    <div class="flex items-center gap-3 text-slate-300">
                         <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="clock" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm">Applied {{ $application->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-white/5">
                    @if($application->resume_path)
                    <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-3 bg-slate-700 hover:bg-slate-600 text-white rounded-xl font-bold transition-all">
                        <i data-lucide="file-text" class="w-4 h-4"></i>
                        Download Resume
                    </a>
                    @else
                    <button disabled class="w-full py-3 bg-slate-800 text-slate-500 rounded-xl font-bold cursor-not-allowed">
                        No Resume Uploaded
                    </button>
                    @endif
                </div>
            </div>

            <!-- Status Control -->
            <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4">Update Status</h3>
                <form action="{{ route('hr-manager.applications.update', $application) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-4">
                        <select name="status" class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            @foreach(['New', 'Screening', 'Interview', 'Offered', 'Hired', 'Rejected'] as $status)
                                <option value="{{ $status }}" {{ $application->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Internal Notes</label>
                        <textarea name="notes" rows="4" class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-slate-600" placeholder="Interview feedback, salary discussions...">{{ $application->notes }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-bold transition-colors shadow-lg shadow-indigo-500/20">
                        Update Application
                    </button>
                </form>
            </div>
        </div>

        <!-- Cover Letter / Details -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-8 backdrop-blur-sm h-full">
                <h3 class="text-lg font-black text-white mb-6 flex items-center gap-2">
                    <i data-lucide="file-text" class="text-indigo-400"></i> Cover Letter
                </h3>
                
                @if($application->cover_letter)
                    <div class="prose prose-invert max-w-none text-slate-300 whitespace-pre-wrap leading-relaxed">
                        {{ $application->cover_letter }}
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center h-64 text-slate-500">
                        <i data-lucide="file-minus" class="w-12 h-12 mb-4 opacity-50"></i>
                        <p>No cover letter submitted.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
