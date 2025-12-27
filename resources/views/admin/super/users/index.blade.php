@extends('layouts.admin')

@section('header', 'System Users')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-white mb-1">User Management</h1>
        <p class="text-slate-400 text-sm">Manage system access, roles, and security.</p>
    </div>
    <a href="{{ route('super-admin.users.create') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
        <i data-lucide="user-plus" class="w-4 h-4"></i> Add New User
    </a>
</div>

<div class="bg-slate-800 rounded-xl border border-white/5 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-400">
            <thead class="bg-slate-900/50 text-xs uppercase font-semibold text-slate-300">
                <tr>
                    <th class="px-6 py-4">User</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Last Login</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($users as $user)
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold text-xs">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-white font-medium">{{ $user->name }}</div>
                                <div class="text-xs text-slate-500">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 rounded text-[10px] uppercase font-bold bg-indigo-500/10 text-indigo-400">
                            {{ $user->roles->first()->name ?? 'No Role' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-emerald-400 flex items-center gap-1.5 text-xs font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Active
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-500 text-xs">
                        {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button title="Reset Password" class="text-slate-400 hover:text-white transition-colors">
                                <i data-lucide="key" class="w-4 h-4"></i>
                            </button>
                            <button title="Edit" class="text-slate-400 hover:text-white transition-colors">
                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                        No users found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="p-4 border-t border-white/5">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
