@extends('layouts.admin')

@section('header', 'Role Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-white mb-1">Roles & Permissions</h1>
        <p class="text-slate-400 text-sm">Define system access levels.</p>
    </div>
    <a href="{{ route('super-admin.roles.create') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
        <i data-lucide="shield-check" class="w-4 h-4"></i> Create Role
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($roles as $role)
    <div class="bg-slate-800 rounded-xl border border-white/5 p-6 relative group hover:border-indigo-500/50 transition-colors">
        <div class="flex justify-between items-start mb-4">
            <div class="w-10 h-10 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                <i data-lucide="shield" class="w-5 h-5"></i>
            </div>
            <div class="text-xs font-mono text-slate-500">ID: {{ $role->id }}</div>
        </div>
        
        <h3 class="text-lg font-bold text-white mb-2">{{ $role->name }}</h3>
        
        <div class="space-y-2 mb-4">
            <div class="text-xs text-slate-400 font-medium uppercase tracking-wider">Permissions</div>
            <div class="flex flex-wrap gap-1">
                @forelse($role->permissions->take(5) as $perm)
                    <span class="px-2 py-0.5 rounded text-[10px] bg-slate-700 text-slate-300 border border-white/5">
                        {{ $perm->name }}
                    </span>
                @empty
                    <span class="text-xs text-slate-600 italic">No specific permissions</span>
                @endforelse
                @if($role->permissions->count() > 5)
                    <span class="px-2 py-0.5 rounded text-[10px] bg-slate-700 text-slate-300 border border-white/5">
                        +{{ $role->permissions->count() - 5 }}
                    </span>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-12 text-center">
        <div class="w-16 h-16 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="shield-off" class="w-8 h-8 text-slate-600"></i>
        </div>
        <h3 class="text-white font-medium mb-1">No Roles Found</h3>
        <p class="text-slate-500 text-sm">Create a role to get started.</p>
    </div>
    @endforelse
</div>
@endsection
