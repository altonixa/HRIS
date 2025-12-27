@extends('layouts.public')

@section('title', $job->title)

@section('content')
<section class="py-20 lg:py-32 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-5xl mx-auto">
            <a href="{{ route('careers.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-purple-600 font-bold text-xs uppercase tracking-widest mb-12 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to All Jobs
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-12">
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <span class="px-3 py-1 bg-purple-50 text-purple-700 rounded-lg text-[10px] font-black uppercase tracking-widest border border-purple-100">
                                {{ $job->department->name ?? 'GENERAL' }}
                            </span>
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-lg text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                                ACTIVE
                            </span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter mb-6 leading-tight">
                            {{ $job->title }}
                        </h1>
                        <div class="flex items-center gap-6 text-slate-500 text-sm">
                            <span class="flex items-center gap-2 text-purple-600 font-bold"><i data-lucide="map-pin" class="w-4 h-4"></i> {{ $job->location }}</span>
                            <span class="flex items-center gap-2 font-medium"><i data-lucide="calendar" class="w-4 h-4"></i> Posted {{ $job->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <div class="prose max-w-none text-slate-600 leading-relaxed space-y-10">
                        <div>
                            <h3 class="text-slate-900 text-xl font-bold mb-4 flex items-center gap-2">
                                <i data-lucide="info" class="w-5 h-5 text-purple-600"></i> Role Overview
                            </h3>
                            <div class="whitespace-pre-line text-lg bg-slate-50 p-8 rounded-xl border border-slate-100">{{ $job->description }}</div>
                        </div>

                        <div>
                            <h3 class="text-slate-900 text-xl font-bold mb-4 flex items-center gap-2">
                                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i> Requirements
                            </h3>
                            <div class="whitespace-pre-line">{{ $job->requirements }}</div>
                        </div>
                        
                        <div>
                            <h3 class="text-slate-900 text-xl font-bold mb-4 flex items-center gap-2">
                                <i data-lucide="award" class="w-5 h-5 text-amber-600"></i> Benefits
                            </h3>
                            <div class="whitespace-pre-line">{{ $job->benefits }}</div>
                        </div>
                    </div>
                </div>

                <!-- Application Form -->
                <div>
                    <div class="sticky top-32">
                        <div class="bg-white border border-slate-200 p-8 rounded-xl shadow-2xl relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-1 bg-purple-600"></div>
                            
                            <h3 class="text-2xl font-black text-slate-900 mb-2 tracking-tight">Apply for this role</h3>
                            <p class="text-xs text-slate-400 mb-8 font-bold uppercase tracking-widest">Start your journey today</p>

                            @if(session('success'))
                                <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 p-6 rounded-xl mb-8 animate-fade-in">
                                    <i data-lucide="check-circle" class="w-8 h-8 mb-3"></i>
                                    <p class="text-xs font-bold">{{ session('success') }}</p>
                                </div>
                            @endif

                            <form action="{{ route('careers.apply', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Full Name</label>
                                    <input type="text" name="full_name" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:ring-2 focus:ring-purple-500 transition-all outline-none">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Work Email</label>
                                    <input type="email" name="email" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:ring-2 focus:ring-purple-500 transition-all outline-none">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Phone Number</label>
                                    <input type="text" name="phone" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:ring-2 focus:ring-purple-500 transition-all outline-none">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Resume (PDF)</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-xl hover:border-purple-300 transition-all relative">
                                        <div class="space-y-1 text-center">
                                            <i data-lucide="upload-cloud" class="mx-auto h-10 w-10 text-slate-300"></i>
                                            <div class="flex text-sm text-slate-600">
                                                <label for="resume-upload" class="relative cursor-pointer bg-white rounded-md font-bold text-purple-600 hover:text-purple-500">
                                                    <span>Upload a file</span>
                                                    <input id="resume-upload" name="resume" type="file" required accept=".pdf" class="sr-only">
                                                </label>
                                            </div>
                                            <p class="text-xs text-slate-400">PDF up to 2MB</p>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="w-full py-4 bg-slate-900 hover:bg-purple-600 text-white rounded-xl font-black transition-all shadow-xl shadow-slate-900/10">
                                    Submit Application
                                </button>
                                <p class="text-[9px] text-center text-slate-400 mt-4 leading-relaxed font-bold uppercase tracking-tighter">
                                    By submitting, you agree to our data privacy policy for candidate evaluation.
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
