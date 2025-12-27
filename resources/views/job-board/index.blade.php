@extends('layouts.public')

@section('title', 'Careers & Opportunities')

@section('content')
<!-- Header -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="container mx-auto px-6 text-center relative z-10">
        <h1 class="text-5xl md:text-6xl font-black tracking-tighter text-slate-900 mb-6">
            Join the <span class="text-purple-600">Altonixa</span> Mission.
        </h1>
        <p class="text-xl text-slate-600 leading-relaxed max-w-3xl mx-auto mb-12">
            Build the infrastructure of the future. We're looking for driven individuals to help us scale organizational excellence across the continent.
        </p>

        <!-- Filters (Mock) -->
        <div class="flex flex-wrap justify-center gap-4">
            <button class="bg-purple-600 text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-purple-600/20 active:scale-95 transition-all">All Positions</button>
            <button class="bg-white border border-slate-200 text-slate-600 px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-slate-50 transition-all">Engineering</button>
            <button class="bg-white border border-slate-200 text-slate-600 px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-slate-50 transition-all">Human Resources</button>
            <button class="bg-white border border-slate-200 text-slate-600 px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-slate-50 transition-all">Operations</button>
        </div>
    </div>
</section>

<!-- Job List -->
<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($jobs as $job)
            <div class="bg-white border border-slate-200 p-8 rounded-xl hover:border-purple-300 transition-all group relative overflow-hidden shadow-sm">
                <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 transition-opacity">
                    <i data-lucide="briefcase" class="w-16 h-16 text-purple-600"></i>
                </div>
                
                <span class="inline-block px-3 py-1 bg-purple-50 text-purple-700 rounded-lg text-[10px] font-black uppercase tracking-widest mb-4 border border-purple-100">
                    {{ $job->department->name ?? 'GENERAL' }}
                </span>
                
                <h3 class="text-xl font-black text-slate-900 mb-2 group-hover:text-purple-600 transition-colors">
                    {{ $job->title }}
                </h3>
                
                <div class="flex items-center gap-4 text-slate-500 text-xs font-bold mb-8">
                    <span class="flex items-center gap-1.5"><i data-lucide="map-pin" class="w-3 h-3 text-purple-500"></i> {{ $job->location }}</span>
                    <span class="flex items-center gap-1.5"><i data-lucide="clock" class="w-3 h-3 text-emerald-500"></i> Full-Time</span>
                </div>
                
                <a href="{{ route('careers.show', $job->id) }}" class="flex items-center justify-between w-full py-4 px-6 bg-slate-900 hover:bg-purple-600 text-white rounded-xl font-bold transition-all group-hover:shadow-xl shadow-slate-900/10">
                    Apply Now
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
            @empty
            <div class="col-span-full py-20 text-center animate-fade-in">
                <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center text-slate-300 mx-auto mb-6 border border-slate-100 shadow-sm">
                    <i data-lucide="briefcase" class="w-10 h-10"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-3 tracking-tight">Our team is growing fast.</h3>
                <p class="text-slate-600 max-w-md mx-auto leading-relaxed">
                    We don't have any open vacancies at this exact moment, but excellence never sleeps. Check back soon or follow us for future opportunities.
                </p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-16">
            {{ $jobs->links() }}
        </div>
    </div>
</section>

<!-- Vision Section -->
<section class="py-24 bg-white border-y border-slate-100">
    <div class="container mx-auto px-6 max-w-4xl text-center">
        <h2 class="text-4xl font-black text-slate-900 mb-8 tracking-tighter">Don't see a fit but believe in the mission?</h2>
        <p class="text-xl text-slate-600 mb-10 leading-relaxed">
            We are always looking for missionaries, not just mercenaries. If you want to build technologies that empower African organizations, reach out.
        </p>
        <div class="inline-flex flex-col items-center">
            <span class="text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Direct Inquiry</span>
            <a href="mailto:talent@altonixa.com" class="text-purple-600 font-black text-2xl border-b-2 border-purple-200 hover:border-purple-600 transition-all pb-1">
                talent@altonixa.com
            </a>
        </div>
    </div>
</section>
@endsection
