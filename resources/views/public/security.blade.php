@extends('layouts.public')

@section('title', 'Security & Compliance')

@section('content')
<!-- Header -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="container mx-auto px-6 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 mb-6 bg-purple-50 text-purple-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest border border-purple-200">
            <i data-lucide="shield-check" class="w-4 h-4"></i>
            Enterprise Trust
        </div>
        <h1 class="text-5xl md:text-6xl font-black tracking-tighter text-slate-900 mb-6">
            Security at <span class="text-purple-600">Scale.</span>
        </h1>
        <p class="text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto mb-16">
            We understand that employee data is your most sensitive asset. That's why Altonixa HRIS is built with a security-first architecture.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white border border-slate-200 p-8 rounded-xl text-center shadow-sm">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 mb-6 mx-auto">
                    <i data-lucide="lock" class="w-6 h-6"></i>
                </div>
                <h4 class="text-slate-900 font-bold mb-2">Data Encryption</h4>
                <p class="text-xs text-slate-600">All data is encrypted at rest and in transit using AES-256 standards.</p>
            </div>
            <div class="bg-white border border-slate-200 p-8 rounded-xl text-center shadow-sm">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600 mb-6 mx-auto">
                    <i data-lucide="database" class="w-6 h-6"></i>
                </div>
                <h4 class="text-slate-900 font-bold mb-2">Isolated Tenants</h4>
                <p class="text-xs text-slate-600">Strict data isolation between organizations ensures zero data leakage.</p>
            </div>
            <div class="bg-white border border-slate-200 p-8 rounded-xl text-center shadow-sm">
                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center text-amber-600 mb-6 mx-auto">
                    <i data-lucide="eye" class="w-6 h-6"></i>
                </div>
                <h4 class="text-slate-900 font-bold mb-2">Full Audit Trail</h4>
                <p class="text-xs text-slate-600">Immutable logs for every single action performed within the system.</p>
            </div>
            <div class="bg-white border border-slate-200 p-8 rounded-xl text-center shadow-sm">
                <div class="w-12 h-12 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600 mb-6 mx-auto">
                    <i data-lucide="key" class="w-6 h-6"></i>
                </div>
                <h4 class="text-slate-900 font-bold mb-2">RBAC Control</h4>
                <p class="text-xs text-slate-600">Granular role-based access to ensure users only see what they need.</p>
            </div>
        </div>
    </div>
</section>

<!-- Detailed Compliance Sections -->
<section class="py-24 bg-slate-50 border-y border-slate-100">
    <div class="container mx-auto px-6">
        <div class="space-y-32">
            <!-- Section 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-6">GDPR & Data Privacy Readiness</h2>
                    <p class="text-slate-600 text-lg leading-relaxed mb-6">
                        Altonixa HRIS is engineered to help organizations comply with modern data privacy regulations, including GDPR and local data protection laws.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 text-sm text-slate-600">
                            <i data-lucide="check-circle" class="w-5 h-5 text-purple-600"></i>
                            Right to Access & Rectification tools
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-600">
                            <i data-lucide="check-circle" class="w-5 h-5 text-purple-600"></i>
                            Data Portability (Bulk Export features)
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-600">
                            <i data-lucide="check-circle" class="w-5 h-5 text-purple-600"></i>
                            Automatic Consent Logging
                        </li>
                    </ul>
                </div>
                <div class="bg-white border border-slate-200 p-12 rounded-xl shadow-2xl relative">
                    <div class="absolute -top-6 -left-6 bg-purple-600 text-white p-4 rounded-lg shadow-xl">
                        <i data-lucide="shield" class="w-8 h-8"></i>
                    </div>
                    <div class="space-y-8">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-slate-900 font-bold text-xs uppercase tracking-widest">Access Control</span>
                                <span class="bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded text-[10px] font-bold border border-emerald-200">VERIFIED</span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="w-full h-full bg-emerald-500"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-slate-900 font-bold text-xs uppercase tracking-widest">Data Isolation</span>
                                <span class="bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded text-[10px] font-bold border border-emerald-200">VERIFIED</span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="w-full h-full bg-emerald-500"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
                <div class="order-2 md:order-1 relative">
                    <div class="absolute inset-0 bg-purple-500/10 blur-[100px]"></div>
                    <div class="relative bg-white border border-slate-200 rounded-xl p-8 font-mono text-xs text-purple-600 leading-relaxed shadow-2xl">
                        <div class="flex gap-2 mb-4 border-b border-slate-100 pb-4">
                            <div class="w-2 h-2 rounded-full bg-red-400"></div>
                            <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                            <div class="w-2 h-2 rounded-full bg-green-400"></div>
                        </div>
                        <div class="text-slate-600">
                        [AUTH_LOG]: User "Admin_01" accessed Payroll Records.<br>
                        [AUTH_LOG]: Action: EXPORT_TO_PDF | Status: SUCCESS<br>
                        [AUTH_LOG]: IP: 192.168.1.104 | Time: {{ date('Y-m-d H:i:s') }}<br>
                        [AUTH_LOG]: Metadata: PID_404 | RID_89<br>
                        <br>
                        <span class="font-bold text-emerald-600">-- LOGS ARE ENCRYPTED AND IMMUTABLE --</span>
                        </div>
                    </div>
                </div>
                <div class="order-1 md:order-2">
                    <h2 class="text-3xl font-bold text-slate-900 mb-6">Immutable Audit Logging</h2>
                    <p class="text-slate-600 text-lg leading-relaxed mb-6">
                        Every managerial action, from payroll processing to leave approval, is logged. These logs cannot be edited or deleted, even by the system owner, providing a foolproof trail for internal or external auditors.
                    </p>
                    <div class="bg-purple-50 border border-purple-100 p-6 rounded-xl">
                        <h4 class="text-purple-700 font-bold text-sm mb-2">Why this matters for NGOs?</h4>
                        <p class="text-slate-600 text-xs leading-relaxed">
                            Donor accountability requires proof of transparency. Our audit logs provide ready-to-use reports for humanitarian funding compliance.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-24 text-center bg-purple-600 relative overflow-hidden">
    <div class="container mx-auto px-6 relative z-10">
        <h2 class="text-4xl font-black text-white mb-8 tracking-tighter">Ready to secure your workforce data?</h2>
        <div class="flex flex-col md:flex-row justify-center gap-4">
            <a href="{{ route('public.home') }}#demo" class="bg-white text-purple-600 px-8 py-4 rounded-xl font-black transition-all hover:scale-105 shadow-2xl shadow-black/20">
                Setup Secure Instance
            </a>
            <a href="{{ route('public.home') }}#demo" class="bg-purple-700 text-white border border-purple-400/30 px-8 py-4 rounded-xl font-black transition-all hover:bg-purple-800">
                Download Security Whitepaper
            </a>
        </div>
    </div>
</section>
@endsection
