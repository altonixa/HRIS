@extends('layouts.admin')

@section('header', 'Update Training Status')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white border border-slate-200 rounded-xl p-10 shadow-sm relative overflow-hidden">
        
        <div class="mb-10 flex items-center gap-6">
            <div class="w-16 h-16 bg-slate-50 rounded-xl flex items-center justify-center border border-slate-200 text-purple-600">
                <i data-lucide="award" class="w-8 h-8"></i>
            </div>
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $training->employee->first_name }}'s Progress</h2>
                <p class="text-purple-600 text-sm font-bold uppercase tracking-widest">{{ $training->course->title }}</p>
            </div>
        </div>

        <form action="{{ route('hr-manager.trainings.update', $training->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Lifecycle Status</label>
                    <select name="status" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-bold appearance-none">
                        <option value="assigned" {{ $training->status === 'assigned' ? 'selected' : '' }}>Assigned</option>
                        <option value="in_progress" {{ $training->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $training->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="failed" {{ $training->status === 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Assessment Score (%)</label>
                    <input type="number" name="score" value="{{ $training->score }}" min="0" max="100" placeholder="0 - 100" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Completion Date</label>
                    <input type="date" name="completion_date" value="{{ $training->completion_date ? $training->completion_date->format('Y-m-d') : '' }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-bold">
                </div>
            </div>

            <div class="space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Digital Certificate Archive</label>
                <div class="relative group">
                    <input type="file" name="certificate" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="w-full bg-slate-50 border-2 border-dashed border-slate-200 group-hover:border-purple-600/50 rounded-xl p-10 text-center transition-all">
                        <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 mx-auto mb-4 group-hover:text-purple-600 group-hover:scale-110 transition-all">
                            <i data-lucide="cloud-upload" class="w-6 h-6"></i>
                        </div>
                        <p class="text-slate-900 font-bold text-sm">Upload verifiable certificate PDF/Image</p>
                        <p class="text-slate-500 text-xs mt-1">Maximum file size: 5MB</p>
                    </div>
                </div>
                @if($training->certificate_path)
                <div class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-100 rounded-xl animate-fade-in">
                    <i data-lucide="paperclip" class="w-4 h-4 text-emerald-600"></i>
                    <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Existing certificate archived</span>
                    <a href="{{ Storage::url($training->certificate_path) }}" target="_blank" class="ml-auto text-[10px] font-black text-slate-700 px-3 py-1 bg-slate-100 hover:bg-slate-200 rounded-lg">VIEW PREVIOUS</a>
                </div>
                @endif
            </div>

            <div class="flex gap-4 pt-6">
                <a href="{{ route('hr-manager.trainings.index') }}" class="flex-1 py-4 bg-slate-50 hover:bg-slate-100 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl text-center border border-slate-200 transition-all">
                    Discard Changes
                </a>
                <button type="submit" class="flex-1 py-4 bg-purple-600 hover:bg-purple-700 text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-sm transition-all">
                    Commit Updates
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
