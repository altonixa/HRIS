@extends('layouts.admin')

@section('header', 'Expense Management')

@section('content')
<div class="space-y-8">
    <!-- Header Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-slate-900 border border-white/5 rounded-[32px] p-6 backdrop-blur-sm">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-10 h-10 bg-indigo-500/10 rounded-xl flex items-center justify-center text-indigo-400">
                    <i data-lucide="wallet" class="w-5 h-5"></i>
                </div>
                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Total Claims</div>
            </div>
            <div class="text-2xl font-black text-white leading-none">{{ $claims->total() }}</div>
        </div>
        <div class="bg-slate-900 border border-white/5 rounded-[32px] p-6 backdrop-blur-sm">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-10 h-10 bg-amber-500/10 rounded-xl flex items-center justify-center text-amber-400">
                    <i data-lucide="clock" class="w-5 h-5"></i>
                </div>
                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Pending Audit</div>
            </div>
            <div class="text-2xl font-black text-white leading-none">{{ $claims->where('status', 'pending')->count() }}</div>
        </div>
        <div class="col-span-1 md:col-span-2 flex justify-end items-center">
            <a href="{{ route('employee.expenses.create') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-4 rounded-2xl font-black text-sm transition-all shadow-xl shadow-indigo-600/30 flex items-center gap-3">
                <i data-lucide="plus" class="w-5 h-5"></i> Submit New Claim
            </a>
        </div>
    </div>

    <!-- Inventory Table -->
    <div class="bg-slate-900 border border-white/5 rounded-[40px] overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white/5">
                    <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Claim Details</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Category</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Amount</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Status</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Date</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($claims as $claim)
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center text-slate-400 group-hover:text-indigo-400 transition-colors">
                                <i data-lucide="file-text" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <div class="text-sm font-black text-white">{{ $claim->title }}</div>
                                <div class="text-[10px] text-slate-500 font-bold max-w-xs truncate">{{ $claim->description }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-xs font-bold text-slate-400 bg-white/5 px-3 py-1 rounded-full uppercase tracking-tighter">{{ $claim->category }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-sm font-black text-white italic">{{ number_format($claim->amount, 0) }} <span class="text-[10px] text-slate-500">{{ $claim->currency }}</span></div>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $statusStyles = [
                                'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                'approved' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                'rejected' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
                                'paid' => 'bg-indigo-500/10 text-indigo-500 border-indigo-500/20'
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $statusStyles[$claim->status] ?? $statusStyles['pending'] }}">
                            {{ strtoupper($claim->status) }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-sm font-bold text-slate-500">
                        {{ $claim->claim_date->format('M d, Y') }}
                    </td>
                    <td class="px-8 py-6">
                        @if($claim->receipt_path)
                            <a href="{{ Storage::url($claim->receipt_path) }}" target="_blank" class="p-2 hover:bg-white/5 rounded-xl text-slate-400 hover:text-white transition-all inline-block">
                                <i data-lucide="paperclip" class="w-4 h-4"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-20 text-center">
                        <div class="w-16 h-16 bg-slate-800 rounded-3xl flex items-center justify-center text-slate-600 mx-auto mb-4">
                            <i data-lucide="receipt" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-white font-bold mb-1">No expense claims found</h3>
                        <p class="text-slate-500 text-sm">Submit your first claim using the button above.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($claims->hasPages())
        <div class="px-8 py-6 bg-white/5 border-t border-white/5">
            {{ $claims->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
