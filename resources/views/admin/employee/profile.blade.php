@extends('layouts.admin')

@section('header', 'My Digital Identity')

@section('content')
<div x-data="{ activeTab: 'summary' }">
    <!-- Profile Header -->
    <div class="bg-slate-900/50 border border-white/5 rounded-[40px] p-8 mb-8 backdrop-blur-sm relative overflow-hidden">
        <div class="absolute top-0 right-0 p-12 opacity-5">
            <i data-lucide="shield" class="w-48 h-48 text-indigo-500"></i>
        </div>
        
        <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
            <div class="w-28 h-28 rounded-3xl bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white text-4xl font-black shadow-2xl">
                @if($employee->profile_picture)
                    <img src="{{ Storage::url($employee->profile_picture) }}" class="w-full h-full object-cover rounded-3xl">
                @else
                    {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                @endif
            </div>
            
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-3xl font-black text-white tracking-tighter mb-1">{{ $employee->first_name }} {{ $employee->last_name }}</h1>
                <p class="text-indigo-400 font-bold mb-4 uppercase tracking-widest text-[10px]">
                    {{ $employee->designation->name ?? 'EMPLOYEE' }} • {{ $employee->department->name ?? 'GENERAL' }}
                </p>
                <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                    <span class="text-slate-500 text-xs font-bold px-3 py-1 bg-white/5 rounded-lg border border-white/5">CODE: {{ $employee->employee_code }}</span>
                    <span class="text-slate-500 text-xs font-bold px-3 py-1 bg-white/5 rounded-lg border border-white/5">EMAIL: {{ $employee->user->email }}</span>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('profile.edit') }}" class="bg-white/5 hover:bg-white/10 text-white px-6 py-3 rounded-2xl font-bold transition-all border border-white/5 flex items-center gap-2">
                    <i data-lucide="settings" class="w-4 h-4"></i> Account Settings
                </a>
            </div>
        </div>
    </div>

    <!-- Hub Navigation -->
    <div class="flex gap-2 mb-8 bg-slate-900/50 p-1.5 rounded-2xl border border-white/5 w-fit overflow-x-auto">
        <button @click="activeTab = 'summary'" :class="activeTab === 'summary' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-white/5'" class="px-6 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center gap-2 whitespace-nowrap">
            <i data-lucide="layout" class="w-4 h-4"></i> Overview
        </button>
        <button @click="activeTab = 'docs'" :class="activeTab === 'docs' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-white/5'" class="px-6 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center gap-2 whitespace-nowrap">
            <i data-lucide="folder-lock" class="w-4 h-4"></i> My Documents
        </button>
        <button @click="activeTab = 'contacts'" :class="activeTab === 'contacts' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-white/5'" class="px-6 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center gap-2 whitespace-nowrap">
            <i data-lucide="heart" class="w-4 h-4"></i> Emergency Safety
        </button>
    </div>

    <!-- Views -->
    <div class="space-y-8 min-h-[400px]">
        <!-- Overview Tab -->
        <div x-show="activeTab === 'summary'" x-cloak class="animate-fade-in grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-slate-900/50 border border-white/5 rounded-3xl p-8">
                    <h3 class="text-sm font-black uppercase tracking-widest text-slate-500 mb-6">Employment Lifecycle</h3>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <div class="text-[10px] font-black text-slate-600 uppercase mb-1">Join Date</div>
                            <div class="text-xs font-bold text-white">{{ $employee->joining_date->format('M d, Y') }}</div>
                        </div>
                        <div>
                            <div class="text-[10px] font-black text-slate-600 uppercase mb-1">Reporting To</div>
                            <div class="text-xs font-bold text-indigo-400">{{ $employee->manager ? $employee->manager->first_name : 'Direct Office' }}</div>
                        </div>
                        <div>
                            <div class="text-[10px] font-black text-slate-600 uppercase mb-1">Contract Type</div>
                            <div class="text-xs font-bold text-white">Full-Time / Permanent</div>
                        </div>
                        <div>
                            <div class="text-[10px] font-black text-slate-600 uppercase mb-1">Probation</div>
                            <div class="text-xs font-bold text-emerald-400">Completed</div>
                        </div>
                    </div>
                </div>

                <div class="bg-indigo-600/10 border border-indigo-500/20 rounded-3xl p-8 flex items-center gap-6">
                    <div class="w-12 h-12 bg-indigo-500 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-indigo-600/40">
                        <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-1">Safety Reminder</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">Ensure your emergency contact details are up to date. In case of field operations, this is mandatory for insurance coverage.</p>
                    </div>
                </div>
            </div>
            
            <div class="space-y-6">
                <x-activity-feed title="System Security Log">
                    <div class="activity-item">
                        <div class="activity-icon bg-cyan-500/10 text-cyan-400"><i data-lucide="shield-check" class="w-4 h-4"></i></div>
                        <div class="activity-content">
                            <div class="activity-title text-white">Profile Verified</div>
                            <div class="activity-description">Digital ID matched with record.</div>
                            <div class="activity-time">Continuous</div>
                        </div>
                    </div>
                </x-activity-feed>
            </div>
        </div>

        <!-- Documents Tab -->
        <div x-show="activeTab === 'docs'" x-cloak class="animate-fade-in">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($employee->documents as $doc)
                <div class="bg-slate-900 border border-white/5 rounded-3xl p-6 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 bg-indigo-500/10 rounded-xl flex items-center justify-center text-indigo-400">
                            <i data-lucide="file" class="w-5 h-5"></i>
                        </div>
                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="text-xs font-bold text-indigo-400 hover:text-white transition-colors">VIEW FILE</a>
                    </div>
                    <h4 class="text-white font-bold text-sm mb-1">{{ $doc->title }}</h4>
                    <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest">{{ $doc->type }}</p>
                </div>
                @empty
                <div class="col-span-full py-16 text-center bg-slate-900/30 rounded-3xl border border-dashed border-white/10">
                    <p class="text-slate-500 text-sm italic">No digital files have been archived in your repository yet.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Safety/Contact Tab -->
        <div x-show="activeTab === 'contacts'" x-cloak class="animate-fade-in">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($employee->emergencyContacts as $contact)
                <div class="bg-slate-900 border border-white/5 rounded-3xl p-8 relative overflow-hidden">
                    <div class="flex items-center gap-6">
                        <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center text-slate-400 font-bold border border-white/5">
                            {{ substr($contact->name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="text-white font-bold">{{ $contact->name }}</h4>
                            <p class="text-xs text-indigo-400 uppercase font-black tracking-widest">{{ $contact->relationship }}</p>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center gap-3 text-slate-400 text-sm">
                        <i data-lucide="phone" class="w-4 h-4 text-slate-600"></i>
                        {{ $contact->phone }}
                    </div>
                </div>
                @empty
                <div class="col-span-full py-16 text-center bg-slate-900/30 rounded-3xl border border-dashed border-white/10">
                    <p class="text-slate-500 text-sm italic">No emergency contact registered. Please notify HR.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
