@extends('layouts.public')

@section('title', 'Infrastructure & About')

@section('content')
<!-- Header -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="container mx-auto px-6 text-center relative z-10">
        <h1 class="text-5xl md:text-6xl font-black tracking-tighter text-slate-900 mb-6">
            The Infrastructure of <span class="text-purple-600">Excellence.</span>
        </h1>
        <p class="text-xl text-slate-600 leading-relaxed max-w-3xl mx-auto">
            Altonixa HRIS is more than just software. It's a high-availability infrastructure built to power organizations that cannot afford downtime.
        </p>
    </div>
</section>

<!-- Our Story/Mission -->
<section class="py-24 bg-slate-50 border-y border-slate-100">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
            <div class="relative group">
                <div class="absolute -inset-4 bg-purple-100 rounded-xl opacity-20 blur-2xl group-hover:opacity-30 transition-opacity"></div>
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1200" alt="Modern Office" class="relative rounded-xl shadow-2xl object-cover h-[500px] w-full border border-slate-200">
            </div>
            <div>
                <span class="text-purple-600 font-bold text-xs uppercase tracking-widest mb-4 block">Our Story</span>
                <h2 class="text-4xl font-bold text-slate-900 mb-8">Empowering African Growth through Technology.</h2>
                <div class="space-y-6 text-slate-600 leading-relaxed">
                    <p>
                        Born out of the Altonixa Group Ltd, we realized that while thousands of brilliant organizations are scaling across the continent, their legacy HR systems were failing them.
                    </p>
                    <p>
                        Spreadsheets were leaking data, payroll was a manual nightmare, and transparency was impossible to maintain. We built Altonixa HRIS to solve this—combining global enterprise standards with local operational realities.
                    </p>
                    <p>
                        Today, we power NGOs in humanitarian sectors, high-growth SMEs in tech and services, and established enterprises managing large-scale workforces.
                    </p>
                </div>
                
                <div class="mt-12 grid grid-cols-3 gap-8 border-t border-slate-200 pt-12">
                    <div>
                        <div class="text-4xl font-black text-slate-900 mb-2">99.9%</div>
                        <div class="text-xs text-slate-500 uppercase tracking-widest font-bold">Uptime</div>
                    </div>
                    <div>
                        <div class="text-4xl font-black text-slate-900 mb-2">256-bit</div>
                        <div class="text-xs text-slate-500 uppercase tracking-widest font-bold">Encrypted</div>
                    </div>
                    <div>
                        <div class="text-4xl font-black text-slate-900 mb-2">24/7</div>
                        <div class="text-xs text-slate-500 uppercase tracking-widest font-bold">Support</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-slate-900 mb-16 text-center">Core Design Principles</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="text-center group">
                <div class="w-20 h-20 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 mb-8 mx-auto group-hover:rotate-12 transition-transform border border-purple-100">
                    <i data-lucide="layers" class="w-10 h-10"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-4">Modular Design</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Enable or disable modules based on your organizational type. NGOs can focus on staff/volunteers, while companies run full payroll.
                </p>
            </div>
            <div class="text-center group">
                <div class="w-20 h-20 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-8 mx-auto group-hover:-rotate-12 transition-transform border border-emerald-100">
                    <i data-lucide="cpu" class="w-10 h-10"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-4">Policy Driven</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    System rules are not hard-coded. They are driven by your organization's specific HR, leave, and payroll policies.
                </p>
            </div>
            <div class="text-center group">
                <div class="w-20 h-20 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 mb-8 mx-auto group-hover:rotate-12 transition-transform border border-amber-100">
                    <i data-lucide="activity" class="w-10 h-10"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-4">Scalable Core</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Whether you manage a team of 10 or a workforce of 100,000, our cloud-native infrastructure scales automatically.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA with Image -->
<section class="py-24 bg-purple-600 rounded-xl mx-6 mb-20 relative overflow-hidden group">
    <div class="container mx-auto px-12 relative z-10 flex flex-col md:flex-row items-center gap-16">
        <div class="flex-1 text-center md:text-left">
            <h2 class="text-5xl font-black text-white leading-tight mb-8">
                Ready to transform your organizational culture?
            </h2>
            <p class="text-xl text-purple-100 mb-10 max-w-lg">
                Join the growing network of excellence-driven organizations powering their growth with Altonixa HRIS.
            </p>
            <a href="{{ route('public.home') }}#demo" class="bg-white text-purple-600 px-10 py-5 rounded-xl font-black text-lg transition-all hover:scale-105 inline-block shadow-2xl">
                Setup Secure Discovery Call
            </a>
        </div>
        <div class="flex-1 hidden md:block">
            <div class="relative p-2 bg-white/10 rounded-xl rotate-3 group-hover:rotate-0 transition-transform duration-700">
                <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&q=80&w=1200" alt="Consultation" class="rounded-lg shadow-2xl">
            </div>
        </div>
    </div>
</section>
@endsection
