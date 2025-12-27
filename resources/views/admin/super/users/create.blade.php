@extends('layouts.admin')

@section('header', 'Create User')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('super-admin.users.index') }}" class="text-slate-400 hover:text-white text-sm flex items-center gap-1 mb-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Users
        </a>
        <h1 class="text-2xl font-bold text-white">Add New User</h1>
        <p class="text-slate-400 text-sm">Create a system account and assign a role.</p>
    </div>

    <div class="bg-slate-800 rounded-xl border border-white/5 p-6">
        <form action="{{ route('super-admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Full Name</label>
                <input type="text" name="name" placeholder="John Doe" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Email Address</label>
                <input type="email" name="email" placeholder="john@company.com" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Password</label>
                    <input type="password" name="password" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                </div>
            </div>
            
            <div>
                <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Role</label>
                <select name="role" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                    <option value="">-- Select Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="flex justify-end pt-4 border-t border-white/5">
                <a href="{{ route('super-admin.users.index') }}" class="px-6 py-2.5 rounded-lg text-slate-400 hover:text-white font-medium transition-colors mr-3">Cancel</a>
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-lg font-medium shadow-lg shadow-primary/25 transition-all">
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
