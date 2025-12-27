@extends('layouts.admin')

@section('header', 'Create Role')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('super-admin.roles.index') }}" class="text-slate-400 hover:text-white text-sm flex items-center gap-1 mb-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Roles
        </a>
        <h1 class="text-2xl font-bold text-white">Create New Role</h1>
        <p class="text-slate-400 text-sm">Define a new access role and assign permissions.</p>
    </div>

    <form action="{{ route('super-admin.roles.store') }}" method="POST">
        @csrf
        <div class="bg-slate-800 rounded-xl border border-white/5 p-6 mb-6">
            <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Role Name</label>
            <input type="text" name="name" placeholder="e.g. Compliance Officer" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
        </div>

        <div class="bg-slate-800 rounded-xl border border-white/5 p-6">
            <h3 class="text-lg font-bold text-white mb-6">Assign Permissions</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($permissions as $group => $perms)
                <div>
                    <h4 class="text-sm font-bold text-indigo-400 uppercase tracking-wider mb-3 pb-2 border-b border-white/5">{{ $group }}</h4>
                    <div class="space-y-2">
                        @foreach($perms as $perm)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="permissions[]" value="{{ $perm->name }}" class="hidden peer">
                            <div class="w-5 h-5 rounded border border-slate-600 bg-slate-900 peer-checked:bg-primary peer-checked:border-primary flex items-center justify-center text-white transition-all">
                                <i data-lucide="check" class="w-3 h-3 opacity-0 peer-checked:opacity-100"></i>
                            </div>
                            <span class="text-slate-400 group-hover:text-white transition-colors text-sm">{{ $perm->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end pt-6">
            <a href="{{ route('super-admin.roles.index') }}" class="px-6 py-2.5 rounded-lg text-slate-400 hover:text-white font-medium transition-colors mr-3">Cancel</a>
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-lg font-medium shadow-lg shadow-primary/25 transition-all">
                Create Role
            </button>
        </div>
    </form>
</div>
@endsection
