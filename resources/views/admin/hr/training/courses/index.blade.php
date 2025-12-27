@extends('layouts.admin')

@section('header', 'Course Catalog')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Enterprise Learning Hub</h2>
        <p class="text-slate-500 text-sm font-medium">Design and manage curated learning paths for the workforce.</p>
    </div>
    <a href="{{ route('hr-manager.courses.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm transition-all flex items-center gap-2">
        <i data-lucide="book-plus" class="w-4 h-4"></i> DEFINE NEW COURSE
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    @forelse($courses as $course)
    <div class="bg-white border border-slate-200 p-8 rounded-xl hover:border-purple-500/30 transition-all group relative overflow-hidden shadow-sm">
        <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 transition-opacity">
            <i data-lucide="graduation-cap" class="w-16 h-16 text-purple-600"></i>
        </div>
        
        <div class="flex items-center justify-between mb-6">
            <span class="inline-block px-3 py-1 bg-purple-500/10 text-purple-600 rounded-lg text-[10px] font-black uppercase tracking-widest">
                {{ $course->category ?? 'GENERAL' }}
            </span>
            <span class="text-[10px] text-slate-400 font-black uppercase tracking-widest flex items-center gap-1.5">
                <i data-lucide="clock" class="w-3 h-3"></i> {{ $course->duration_hours ?? '?' }} hrs
            </span>
        </div>
        
        <h3 class="text-xl font-black text-slate-900 mb-2 group-hover:text-purple-600 transition-colors">
            {{ $course->title }}
        </h3>
        <p class="text-xs text-slate-400 mb-6 font-bold uppercase tracking-widest">{{ $course->code }}</p>
        
        <p class="text-slate-600 text-sm leading-relaxed mb-8 line-clamp-2">
            {{ $course->description ?? 'No detailed syllabus available for this module.' }}
        </p>
        
        <div class="flex items-center justify-between pt-6 border-t border-slate-100">
            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                Provider: <span class="text-slate-700">{{ $course->provider ?? 'Internal' }}</span>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('hr-manager.courses.edit', $course->id) }}" class="p-2.5 bg-slate-50 hover:bg-slate-100 rounded-xl text-slate-400 hover:text-slate-600 border border-slate-200 transition-all">
                    <i data-lucide="edit" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-20 text-center bg-slate-50 border border-dashed border-slate-200 rounded-xl">
        <div class="w-20 h-20 bg-slate-100 rounded-xl flex items-center justify-center text-slate-300 mx-auto mb-6 border border-slate-200">
            <i data-lucide="library" class="w-10 h-10"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-2">The catalog is empty.</h3>
        <p class="text-slate-500 text-sm">Start by defining professional development modules for your employees.</p>
    </div>
    @endforelse
</div>

<div>
    {{ $courses->links() }}
</div>
@endsection
