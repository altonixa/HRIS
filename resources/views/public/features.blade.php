@extends('layouts.public')

@section('title', 'Enterprise Features')

@section('content')
<!-- Hero Section -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 text-center">
        <div class="max-w-3xl mx-auto mb-16 animate-fade-in">
            <div class="inline-flex items-center gap-2 mb-6 bg-purple-50 text-purple-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest border border-purple-200">
                Full Capability List
            </div>
            <h1 class="text-5xl md:text-6xl font-black tracking-tighter text-slate-900 mb-6">
                Engineered for <span class="text-purple-600">Scale.</span>
            </h1>
            <p class="text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto">
                Discover the modular, robust, and enterprise-grade features that make Altonixa HRIS the definitive workforce solution for modern organizations.
            </p>
        </div>
    </div>
</section>

<!-- Feature Sections -->
<section class="pb-32 bg-white">
    <div class="container mx-auto px-6 space-y-32">
        
        <!-- A. COMPANY & USER MANAGEMENT -->
        <div>
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-12 bg-purple-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-purple-600/20">
                    <i data-lucide="building-2" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase">Company & User Management</h2>
                    <p class="text-slate-500 font-bold uppercase text-[10px] tracking-widest mt-1">Multi-Tenant Architecture</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-all">
                    <h3 class="font-black text-slate-900 mb-2">Secure Multi-Tenancy</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Each organization operates in its own isolated, secure virtual space with 100% data privacy.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-all">
                    <h3 class="font-black text-slate-900 mb-2">Role-Based Access</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Granular permissions for Super Admin, HR, Managers, Accountants, and regular Employees.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-all">
                    <h3 class="font-black text-slate-900 mb-2">User Hierarchy</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Manage department heads and organizational structure with ease through a visual interface.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-all">
                    <h3 class="font-black text-slate-900 mb-2">Platform Control</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Super admins can monitor platform-wide health and manage client subscription lifecycles.</p>
                </div>
            </div>
        </div>

        <!-- B. EMPLOYEE INFORMATION SYSTEM -->
        <div>
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-12 bg-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-600/20">
                    <i data-lucide="user-square" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase">Employee Information System</h2>
                    <p class="text-slate-500 font-bold uppercase text-[10px] tracking-widest mt-1">Centralized Records</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">Digital Profiles</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Comprehensive tracking of personal details, contact info, and emergency contacts.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">Contract Life</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Manage job positions, salary history, and contract dates with automated expiry alerts.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">Document Vault</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Secure storage for CVs, ID cards, certificates, and digital employment contracts.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">Next of Kin</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Maintain vital emergency information and dependent records for insurance and legal compliance.</p>
                </div>
            </div>
        </div>

        <!-- C. ATTENDANCE & TIME MANAGEMENT -->
        <div>
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-amber-500/20">
                    <i data-lucide="clock" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase">Time & Attendance</h2>
                    <p class="text-slate-500 font-bold uppercase text-[10px] tracking-widest mt-1">Operational Precision</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">QR Code & GPS Clocking</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Modern clock-in/out via mobile QR codes or GPS geofencing for field teams.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">Shift Scheduling</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Create complex shift patterns, assign them to employees, and track real-time compliance.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">Smart Leaves</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Automated workflows for Annual, Sick, and Maternity leave with instant manager approvals.</p>
                </div>
            </div>
        </div>

        <!-- D. PAYROLL MANAGEMENT -->
        <div>
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-600/20">
                    <i data-lucide="wallet" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase">Payroll Engine</h2>
                    <p class="text-slate-500 font-bold uppercase text-[10px] tracking-widest mt-1">Financial Compliance</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">Automated Payroll</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Single-click monthly payroll generation based on attendance and salary structure.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">Statutory Deductions</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Automatic calculation of Taxes, CNPS, and Pension contributions per local laws.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">Digital Payslips</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">PDF payslips delivered instantly to employee portals with full transparency on deductions.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">Mobile Payments</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">API integrations for bulk salary disbursement via Mobile Money and Bank APIs.</p>
                </div>
            </div>
        </div>

        <!-- E. PERFORMANCE & TRAINING -->
        <div>
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-12 bg-rose-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-rose-500/20">
                    <i data-lucide="award" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase">Performance & Training</h2>
                    <p class="text-slate-500 font-bold uppercase text-[10px] tracking-widest mt-1">Talent Development</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">KPI Tracking</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Set, monitor, and evaluate employee objectives through quarterly performance appraisals.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">Training Matrix</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Maintain a unified training calendar and track skill upgrades across the organization.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100">
                    <h3 class="font-black text-slate-900 mb-2">Promotion Pipeline</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Data-driven promotion recommendations based on consistent behavioral and KPI evaluations.</p>
                </div>
            </div>
        </div>

        <!-- F. RECRUITMENT & G. ANALYTICS -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center text-white shadow-lg">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tighter uppercase">Recruitment Module</h2>
                </div>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <i data-lucide="check" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                        <span class="text-sm font-bold text-slate-700">Public Job Board Integration</span>
                    </li>
                    <li class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <i data-lucide="check" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                        <span class="text-sm font-bold text-slate-700">Applicant Tracking System (ATS)</span>
                    </li>
                    <li class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <i data-lucide="check" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                        <span class="text-sm font-bold text-slate-700">Interview Scheduling & Feedback</span>
                    </li>
                </ul>
            </div>
            <div>
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                        <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tighter uppercase">Reports & Analytics</h2>
                </div>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <i data-lucide="check" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                        <span class="text-sm font-bold text-slate-700">Real-time Employee Statistics Dashboard</span>
                    </li>
                    <li class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <i data-lucide="check" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                        <span class="text-sm font-bold text-slate-700">One-Click PDF/Excel Export (HR, Payroll, Leave)</span>
                    </li>
                    <li class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <i data-lucide="check" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                        <span class="text-sm font-bold text-slate-700">Departmental Performance Insights</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- H. SYSTEM ADMIN -->
        <div>
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white">
                    <i data-lucide="shield-alert" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase">System Administration</h2>
                    <p class="text-slate-500 font-bold uppercase text-[10px] tracking-widest mt-1">Audit & Governance</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100 flex items-center gap-6">
                    <div class="w-14 h-14 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-900">
                        <i data-lucide="eye" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <h3 class="font-black text-slate-900">Comprehensive Audit Logs</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">Track every single action within the system—who did what, and when.</p>
                    </div>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl border border-slate-100 flex items-center gap-6">
                    <div class="w-14 h-14 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-900">
                        <i data-lucide="bell-ring" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <h3 class="font-black text-slate-900">Automated Notification System</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">Instant alerts for leave requests, payroll processing, and contract renewals.</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

<!-- Call to Action -->
<section class="py-24 bg-slate-900 text-white relative overflow-hidden">
    <div class="container mx-auto px-6 text-center relative z-10">
        <h2 class="text-4xl md:text-5xl font-black mb-8 tracking-tighter uppercase italic">Ready to transform your workforce?</h2>
        <p class="text-xl text-slate-400 mb-12 max-w-2xl mx-auto font-medium">
            Join the organizations powering their people with Altonixa. The complete implementation starts at 700,000 XAF.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-6">
            <a href="/#demo" class="bg-emerald-600 hover:bg-emerald-500 text-white px-10 py-4 rounded-xl font-black transition-all shadow-xl shadow-emerald-500/20 uppercase tracking-widest">
                Get Started
            </a>
            <a href="{{ route('public.about') }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/10 px-10 py-4 rounded-xl font-black transition-all uppercase tracking-widest">
                Our Infrastructure
            </a>
        </div>
    </div>
</section>
@endsection
