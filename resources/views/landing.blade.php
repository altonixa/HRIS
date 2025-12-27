@extends('layouts.public')

@section('title', 'All-in-One HR & Payroll for Enterprise & NGOs')

@section('content')
<!-- Landing Hero Section -->
<header class="relative -mt-24 pt-48 pb-20 md:pt-64 md:pb-40 overflow-hidden bg-white">
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 mb-8 bg-purple-50 text-purple-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest border border-purple-200 animate-fade-in">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-600"></span>
                </span>
                Enterprise HR Solution
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black tracking-tighter text-slate-900 leading-[1.1] mb-8 animate-fade-in">
                Powering <span class="text-purple-600">People.</span> <br>Scaling <span class="text-emerald-600">Growth.</span>
            </h1>
            
            <p class="text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto mb-12 animate-fade-in" style="animation-delay: 0.1s">
                The definitive All-in-One HR, Payroll & Workforce Management platform built for modern organizations, NGOs, and growth-focused companies.
            </p>
            
            <div class="flex flex-col md:flex-row gap-4 justify-center animate-fade-in" style="animation-delay: 0.2s">
                <a href="#demo" class="bg-purple-600 hover:bg-purple-500 text-white px-8 py-4 rounded-xl font-black text-lg transition-all shadow-lg text-center">
                    Request Personalized Demo
                </a>
                <a href="{{ route('public.features') }}" class="bg-white border-2 border-slate-300 hover:border-slate-400 hover:bg-slate-50 text-slate-900 px-8 py-4 rounded-xl font-black text-lg transition-all text-center">
                    Explore Features
                </a>
            </div>

            <div class="mt-16 flex flex-wrap gap-x-12 gap-y-6 text-slate-400 text-sm font-semibold animate-fade-in" style="animation-delay: 0.3s">
                <div class="flex items-center gap-2"><i data-lucide="shield-check" class="w-5 h-5 text-emerald-600"></i> Local Regulation Payroll</div>
                <div class="flex items-center gap-2"><i data-lucide="users" class="w-5 h-5 text-emerald-600"></i> NGO-Specific Modules</div>
                <div class="flex items-center gap-2"><i data-lucide="eye" class="w-5 h-5 text-emerald-600"></i> Immutable Audit Logs</div>
            </div>
        </div>
    </div>
</header>

<!-- Trust Markers -->
<section class="py-20 border-y border-slate-100 bg-white shadow-sm">
    <div class="container mx-auto px-6 text-center">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400 mb-12">Trusted by organizations across humanitarian & business sectors</p>
        <div class="flex flex-wrap justify-center items-center gap-12 md:gap-24 opacity-40 grayscale hover:grayscale-0 transition-all duration-500">
            <span class="text-2xl font-black text-slate-900 italic">NGO_HUB</span>
            <span class="text-2xl font-black text-slate-900 italic">ALTONIXA</span>
            <span class="text-2xl font-black text-slate-900 italic">E-GROWTH</span>
            <span class="text-2xl font-black text-slate-900 italic">HUMAN_PRIME</span>
            <span class="text-2xl font-black text-slate-900 italic">GLOBAL_AID</span>
        </div>
    </div>
</section>

<!-- Problem/Solution Section -->
<section class="py-32">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
            <div class="relative">
                <div class="absolute top-0 left-0 w-64 h-64 bg-rose-500/5 rounded-full blur-[80px]"></div>
                <h2 class="text-4xl md:text-5xl font-black tracking-tighter text-slate-900 leading-tight mb-8">
                    HR inefficiency silently <br><span class="text-rose-500 underline decoration-4 underline-offset-8">drains</span> your business.
                </h2>
                <p class="text-lg text-slate-500 mb-8 leading-relaxed">
                    Spreadsheets fail. Data gets fragmented. Compliance becomes a gamble. Altonixa HRIS restores total control by uniting your entire workforce operation in a single, high-availability cloud platform.
                </p>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <div class="text-rose-600 font-black text-2xl mb-1">90%</div>
                        <div class="text-slate-400 text-xs font-bold uppercase tracking-widest">Efficiency Leak</div>
                    </div>
                    <div>
                        <div class="text-emerald-600 font-black text-2xl mb-1">100%</div>
                        <div class="text-slate-400 text-xs font-bold uppercase tracking-widest">Visibility Gain</div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 gap-6">
                <div class="bg-white border border-slate-100 p-8 rounded-3xl relative overflow-hidden group hover:border-emerald-500/30 transition-all shadow-sm">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                        <i data-lucide="zap" class="w-24 h-24 text-slate-900"></i>
                    </div>
                    <h4 class="text-slate-900 font-bold text-xl mb-3">Scale Without Complexity</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">System logic that works for a team of 10 or 10,000 without requiring expert technical knowledge.</p>
                </div>
                <div class="bg-white border border-slate-100 p-8 rounded-3xl relative overflow-hidden group hover:border-emerald-500/30 transition-all shadow-sm">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                        <i data-lucide="shield" class="w-24 h-24 text-slate-900"></i>
                    </div>
                    <h4 class="text-slate-900 font-bold text-xl mb-3">Governance by Default</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">Immutable logs and per-module access control built into the core architecture from day one.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Overview -->
<section id="features" class="py-32 bg-slate-50/50 relative">
    <div class="container mx-auto px-6">
        <div class="text-center mb-20">
            <h2 class="text-5xl font-black tracking-tighter text-slate-900 mb-6">Built for Every Phase of the Employee Lifecycle.</h2>
            <p class="text-slate-500 max-w-2xl mx-auto">From recruitment to retirement, every module is meticulously engineered to work in harmony.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            <!-- Multi-Role Card -->
            <div class="bg-white border border-slate-100 p-10 rounded-[40px] hover:border-emerald-500/30 transition-all group shadow-sm">
                <div class="w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-600 mb-8 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                    <i data-lucide="layers" class="w-6 h-6"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4">Enterprise RBAC</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-8">Granular permissions for Super Admins, HR Managers, Finance Officers, and Department Heads.</p>
                <a href="{{ route('public.features') }}" class="text-emerald-600 text-sm font-bold flex items-center gap-2 hover:gap-4 transition-all">Learn more <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
            </div>

            <!-- Payroll Card -->
            <div class="bg-emerald-600 p-10 rounded-[40px] shadow-2xl shadow-emerald-600/20 group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-20 transform translate-x-4 -translate-y-4 group-hover:translate-x-0 group-hover:translate-y-0 transition-transform duration-700">
                    <i data-lucide="banknote" class="w-32 h-32 text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4 relative z-10">Smart Payroll</h3>
                <p class="text-emerald-50 text-sm leading-relaxed mb-8 relative z-10">Automated CNPS, tax calculations, and 1-click batch processing with digital payslip delivery.</p>
                <a href="{{ route('public.features') }}" class="bg-white/10 hover:bg-white/20 text-white px-6 py-2 rounded-xl text-sm font-bold inline-block backdrop-blur-md relative z-10 transition-colors">Details</a>
            </div>

            <!-- ATS Card -->
            <div class="bg-white border border-slate-100 p-10 rounded-[40px] hover:border-emerald-500/30 transition-all group shadow-sm">
                <div class="w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-600 mb-8 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                    <i data-lucide="user-search" class="w-6 h-6"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4">Advanced ATS</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-8">Public job portal, application tracking pipelines, and automated hiring workflows.</p>
                <a href="{{ route('careers.index') }}" class="text-emerald-600 text-sm font-bold flex items-center gap-2 hover:gap-4 transition-all">View Portal <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('public.features') }}" class="text-slate-400 hover:text-slate-900 font-bold transition-colors">View all 15+ Advanced Modules</a>
        </div>
    </div>
</section>

<!-- Demo Section -->
<section id="demo" class="py-32 bg-white relative">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="bg-[#fcfdfc] border border-emerald-500/20 p-12 md:p-20 rounded-[60px] relative overflow-hidden shadow-2xl shadow-emerald-500/5">
            <div class="absolute top-0 left-0 w-full h-2 bg-emerald-600"></div>
            
            <div class="text-center mb-16 relative z-10">
                <h2 class="text-4xl md:text-5xl font-black tracking-tighter text-slate-900 mb-6">Request Your Personalized Demo</h2>
                <p class="text-slate-500 max-w-xl mx-auto">See how Altonixa HRIS can transform your organization's human resources operations. No commitment required.</p>
            </div>

            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-700 p-6 rounded-2xl mb-12 text-center animate-fade-in">
                    <i data-lucide="check-circle" class="w-8 h-8 mx-auto mb-3"></i>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('demo.request') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-3">Full Name *</label>
                        <input type="text" name="name" required placeholder="John Doe" class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-3">Work Email *</label>
                        <input type="email" name="email" required placeholder="john@company.com" class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-3">Organization *</label>
                        <input type="text" name="organization" required placeholder="Organization Name" class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-3">WhatsApp Number *</label>
                        <input type="text" name="whatsapp_number" required placeholder="+237 6xx xxx xxx" class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none">
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-3">Additional Notes</label>
                    <textarea name="message" rows="3" placeholder="Tell us about your organization's specific needs..." class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-slate-900 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none resize-none"></textarea>
                </div>
                <div class="md:col-span-2 mt-4 text-center">
                    <button type="submit" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-500 text-white px-12 py-5 rounded-2xl font-black text-lg transition-all shadow-xl shadow-emerald-600/30">
                        Submit Demo Request <i data-lucide="send" class="w-5 h-5"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
