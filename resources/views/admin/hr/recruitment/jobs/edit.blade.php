@extends('layouts.admin')

@section('header', 'Edit Job Posting')

@section('content')
<div class="container mx-auto max-w-4xl">
    <div class="bg-slate-800/50 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-sm shadow-xl">
        <form action="{{ route('hr-manager.recruitment.update', $jobPosting) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="p-8 space-y-8">
                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Job Title</label>
                        <input type="text" name="title" value="{{ $jobPosting->title }}" required class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-slate-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Department</label>
                        <select name="department_id" class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">General / Corporate</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ $jobPosting->department_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Employment Type</label>
                        <select name="employment_type" required class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            @foreach(['Full-time', 'Part-time', 'Contract', 'Internship', 'Remote'] as $type)
                                <option value="{{ $type }}" {{ $jobPosting->employment_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Location</label>
                        <input type="text" name="location" value="{{ $jobPosting->location }}" required class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Salary Range</label>
                        <input type="text" name="salary_range" value="{{ $jobPosting->salary_range }}" class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>

                <!-- Rich Text -->
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Description</label>
                    <textarea name="description" rows="5" required class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ $jobPosting->description }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Requirements</label>
                    <textarea name="requirements" rows="4" class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ $jobPosting->requirements }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Benefits</label>
                    <textarea name="benefits" rows="3" class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ $jobPosting->benefits }}</textarea>
                </div>

                <!-- Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-white/5">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Publication Status</label>
                        <select name="status" required class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="Draft" {{ $jobPosting->status == 'Draft' ? 'selected' : '' }}>Draft (Internal)</option>
                            <option value="Published" {{ $jobPosting->status == 'Published' ? 'selected' : '' }}>Published (Public)</option>
                            <option value="Closed" {{ $jobPosting->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Closing Date</label>
                        <input type="date" name="closing_date" value="{{ $jobPosting->closing_date ? $jobPosting->closing_date->format('Y-m-d') : '' }}" class="w-full bg-slate-900 border-white/10 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <div class="px-8 py-5 bg-slate-900 border-t border-white/5 flex justify-end gap-4">
                <a href="{{ route('hr-manager.recruitment.index') }}" class="px-6 py-2.5 rounded-xl text-slate-400 hover:text-white font-bold transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-bold transition-colors shadow-lg shadow-indigo-500/20">Update Job Posting</button>
            </div>
        </form>
    </div>
</div>
@endsection
