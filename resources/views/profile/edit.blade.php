@extends('layouts.admin')

@section('header', 'System Identity')

@section('content')
<div class="max-w-5xl mx-auto" x-data="{ tab: 'personal' }">
    
    <!-- Profile Header -->
    <div class="bg-white rounded-xl border border-slate-200 p-8 flex flex-col md:flex-row items-center gap-8 mb-8 shadow-sm">
        <div class="relative group">
            <div class="w-28 h-28 rounded-xl bg-slate-100 overflow-hidden border-2 border-slate-200 shadow-sm transition-all group-hover:border-purple-200">
                @if($employee && $employee->profile_picture)
                    <img src="{{ Storage::url($employee->profile_picture) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-4xl font-black text-slate-300 bg-slate-50">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
            </div>
            <label for="avatar_upload" class="absolute -bottom-2 -right-2 bg-purple-600 text-white p-2 rounded-xl cursor-pointer shadow-lg hover:bg-purple-700 transition-all hover:scale-110 active:scale-95 border-2 border-white" title="Update Profile Image">
                <i data-lucide="camera" class="w-4 h-4"></i>
            </label>
        </div>
        
        <div class="text-center md:text-left flex-1">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-1 uppercase">{{ $user->name }}</h1>
            <p class="text-slate-500 font-medium mb-4 flex items-center justify-center md:justify-start gap-2">
                <i data-lucide="mail" class="w-3.5 h-3.5"></i> {{ $user->email }}
            </p>
            <div class="flex flex-wrap justify-center md:justify-start gap-3">
                <span class="px-3 py-1 rounded-lg text-[10px] uppercase font-black bg-purple-50 text-purple-700 border border-purple-100 tracking-widest">
                    {{ $user->roles->first()->name ?? 'Portal Access' }}
                </span>
                @if($employee)
                <span class="px-3 py-1 rounded-lg text-[10px] uppercase font-black bg-slate-50 text-slate-500 border border-slate-200 tracking-widest">
                    ID: {{ $employee->employee_code }}
                </span>
                @endif
            </div>
        </div>

        <!-- Profile Score -->
        <div class="hidden lg:flex flex-col items-end gap-2 p-4 bg-slate-50 rounded-xl border border-slate-200">
            <div class="text-[9px] text-slate-400 uppercase font-black tracking-widest">Profile Completion</div>
            <div class="w-40 h-2 bg-slate-200 rounded-full overflow-hidden">
                <div class="h-full bg-emerald-600" style="width: 85%"></div>
            </div>
            <div class="text-[10px] font-black text-emerald-600">85% OPTIMIZED</div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="flex gap-1 p-1 bg-slate-100 rounded-xl mb-8 border border-slate-200 max-w-md">
        <button @click="tab = 'personal'" 
                :class="tab === 'personal' ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/20' : 'text-slate-500 hover:text-slate-700'" 
                class="flex-1 px-4 py-2.5 rounded-lg font-black text-[10px] uppercase tracking-widest transition-all focus:outline-none">
            Identity
        </button>
        <button @click="tab = 'employment'" 
                :class="tab === 'employment' ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/20' : 'text-slate-500 hover:text-slate-700'" 
                class="flex-1 px-4 py-2.5 rounded-lg font-black text-[10px] uppercase tracking-widest transition-all focus:outline-none">
            Journey
        </button>
        <button @click="tab = 'security'" 
                :class="tab === 'security' ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/20' : 'text-slate-500 hover:text-slate-700'" 
                class="flex-1 px-4 py-2.5 rounded-lg font-black text-[10px] uppercase tracking-widest transition-all focus:outline-none">
            Security
        </button>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PATCH')
        <input type="file" name="profile_picture" id="avatar_upload" class="hidden" onchange="this.form.submit()">

        <!-- Personal Tab -->
        <div x-show="tab === 'personal'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
            <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
                        <i data-lucide="user" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight uppercase">Core Identity</h3>
                        <p class="text-xs text-slate-500 font-medium">Update your public facing information</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="col-span-full">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Full Legal Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:border-purple-500/50 focus:ring-4 focus:ring-purple-500/5 transition-all placeholder-slate-400">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Primary Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:border-purple-500/50 focus:ring-4 focus:ring-purple-500/5 transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Contact Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $employee->phone ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:border-purple-500/50 focus:ring-4 focus:ring-purple-500/5 transition-all" placeholder="+237 ...">
                    </div>
                    
                    <div class="col-span-full">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">National ID / CNI</label>
                        <input type="text" name="national_id_card" value="{{ old('national_id_card', $employee->national_id_card ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:border-purple-500/50 focus:ring-4 focus:ring-purple-500/5 transition-all" placeholder="Enter ID card number">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight uppercase">Location Pulse</h3>
                        <p class="text-xs text-slate-500 font-medium">Your current residential details</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="col-span-full">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Current Address</label>
                        <input type="text" name="address" value="{{ old('address', $employee->address ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:border-purple-500/50 focus:ring-4 focus:ring-purple-500/5 transition-all">
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">City / Town</label>
                        <input type="text" name="town" value="{{ old('town', $employee->town ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:border-purple-500/50 focus:ring-4 focus:ring-purple-500/5 transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Neighborhood (Quarter)</label>
                        <input type="text" name="quarter" value="{{ old('quarter', $employee->quarter ?? '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:border-purple-500/50 focus:ring-4 focus:ring-purple-500/5 transition-all">
                    </div>
                </div>
            </div>
        </div>

        <!-- Employment Tab -->
        <div x-show="tab === 'employment'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
            <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-10 text-center md:text-left">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
                        <i data-lucide="briefcase" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-slate-900 tracking-tight uppercase">Professional Journey</h3>
                        <p class="text-xs text-slate-500 font-medium">Internal company records (Read Only)</p>
                    </div>
                </div>
                
                @if($employee)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">
                    <div class="space-y-2">
                        <div class="text-[9px] text-slate-400 uppercase font-black tracking-widest">Employee Code</div>
                        <div class="text-slate-900 font-black text-lg tracking-tighter">{{ $employee->employee_code }}</div>
                    </div>
                    <div class="space-y-2">
                        <div class="text-[9px] text-slate-400 uppercase font-black tracking-widest">System Status</div>
                        <div>
                            <span class="px-3 py-1 rounded-full text-[9px] uppercase font-black bg-emerald-50 text-emerald-600 border border-emerald-100">
                                {{ $employee->status }}
                            </span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="text-[9px] text-slate-400 uppercase font-black tracking-widest">Role/Designation</div>
                        <div class="text-slate-700 font-black uppercase text-sm tracking-tight">{{ $employee->designation->title ?? 'N/A' }}</div>
                    </div>
                    <div class="space-y-2">
                        <div class="text-[9px] text-slate-400 uppercase font-black tracking-widest">Entry Date</div>
                        <div class="text-slate-700 font-black text-sm uppercase">{{ $employee->joining_date->format('d M, Y') }}</div>
                    </div>
                </div>
                @else
                <div class="py-10 text-center bg-slate-50 rounded-xl border border-dashed border-slate-200">
                    <i data-lucide="alert-circle" class="w-10 h-10 text-slate-300 mx-auto mb-4"></i>
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">No Employment Record Found</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Security Tab -->
        <div x-show="tab === 'security'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
            <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
                        <i data-lucide="shield-lock" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight uppercase">Authentication Layer</h3>
                        <p class="text-xs text-slate-500 font-medium">Protect your session and credentials</p>
                    </div>
                </div>
                
                <div class="max-w-md space-y-8">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Current Password</label>
                        <input type="password" name="current_password" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:border-purple-500/50 focus:ring-4 focus:ring-purple-500/5 transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">New System Key</label>
                        <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:border-purple-500/50 focus:ring-4 focus:ring-purple-500/5 transition-all">
                        <p class="text-[9px] text-slate-400 mt-3 font-bold uppercase tracking-widest">MIN 8 CHARS + COMPLEXITY</p>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Confirm New Key</label>
                        <input type="password" name="password_confirmation" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 font-bold focus:outline-none focus:border-purple-500/50 focus:ring-4 focus:ring-purple-500/5 transition-all">
                    </div>
                </div>
            </div>
        </div>

        <!-- Global Action Bar -->
        <div class="flex justify-end pt-10 border-t border-slate-200">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-12 py-5 rounded-xl font-black uppercase tracking-widest text-[11px] shadow-lg shadow-purple-600/20 transition-all flex items-center gap-4 active:scale-95 group">
                <i data-lucide="save" class="w-4 h-4 transition-transform group-hover:scale-110"></i>
                Synchronize Changes
            </button>
        </div>
    </form>
</div>
@endsection
