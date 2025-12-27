@extends('layouts.admin')

@section('header', 'Expense Auditing')

@section('content')
<div x-data="{ openAuditModal: false, selectedClaim: null }">
    <div class="space-y-8">
        <!-- Audit Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-indigo-600 rounded-[32px] p-8 shadow-xl shadow-indigo-600/20 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-20 transform translate-x-2 -translate-y-2 group-hover:translate-x-0 group-hover:translate-y-0 transition-transform">
                    <i data-lucide="alert-circle" class="w-16 h-16 text-white"></i>
                </div>
                <div class="text-[10px] font-black text-indigo-200 uppercase tracking-widest mb-1">Awaiting Review</div>
                <div class="text-4xl font-black text-white leading-none">{{ $claims->where('status', 'pending')->count() }}</div>
            </div>
        </div>

        <!-- Global Audit Table -->
        <div class="bg-slate-900 border border-white/5 rounded-[40px] overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5">
                        <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Personnel</th>
                        <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Expense Item</th>
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
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-indigo-500/10 rounded-lg flex items-center justify-center text-indigo-400 font-black text-[10px]">
                                    {{ substr($claim->employee->first_name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-xs font-black text-white italic">{{ $claim->employee->first_name }} {{ $claim->employee->last_name }}</div>
                                    <div class="text-[9px] text-slate-600 font-bold uppercase tracking-tighter">{{ $claim->employee->employee_code }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-xs font-bold text-white mb-0.5">{{ $claim->title }}</div>
                            <div class="text-[9px] text-slate-500 font-black uppercase tracking-widest">{{ $claim->category }}</div>
                        </td>
                        <td class="px-8 py-6 italic">
                            <div class="text-sm font-black text-white">{{ number_format($claim->amount, 0) }} <span class="text-[10px] text-slate-500 font-normal uppercase">{{ $claim->currency }}</span></div>
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
                            <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-[0.1em] border {{ $statusStyles[$claim->status] ?? $statusStyles['pending'] }}">
                                {{ $claim->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                            {{ $claim->claim_date->format('M d, Y') }}
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2">
                                @if($claim->status === 'pending')
                                <button @click="selectedClaim = {{ json_encode($claim) }}; openAuditModal = true" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg transition-all">AUDIT</button>
                                @endif
                                @if($claim->receipt_path)
                                <a href="{{ Storage::url($claim->receipt_path) }}" target="_blank" class="p-2 bg-white/5 hover:bg-white/10 text-slate-400 hover:text-white rounded-lg transition-all">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center text-slate-500 font-bold uppercase tracking-widest text-xs">No claims requiring audit.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Audit Modal -->
    <div x-show="openAuditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-950/80 backdrop-blur-sm">
        <div @click.away="openAuditModal = false" class="bg-slate-900 border border-white/5 w-full max-w-lg rounded-[40px] p-10 shadow-2xl animate-fade-in relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-indigo-600"></div>
            
            <h3 class="text-2xl font-black text-white tracking-tighter mb-6">Financial Audit Review</h3>
            
            <form :action="'/hr-manager/expenses/' + (selectedClaim ? selectedClaim.id : '')" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="mb-8 p-6 bg-white/5 rounded-3xl space-y-3">
                    <div class="flex justify-between text-xs">
                        <span class="text-slate-500 font-bold uppercase tracking-widest">Item</span>
                        <span class="text-white font-black" x-text="selectedClaim ? selectedClaim.title : ''"></span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-slate-500 font-bold uppercase tracking-widest">Amount</span>
                        <span class="text-indigo-400 font-black italic text-sm" x-text="selectedClaim ? (selectedClaim.amount + ' ' + selectedClaim.currency) : ''"></span>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Audit Decision *</label>
                        <select name="status" required class="w-full bg-slate-800 border border-white/5 rounded-xl px-4 py-2.5 text-white outline-none focus:ring-1 focus:ring-indigo-500 appearance-none font-bold">
                            <option value="approved">Approve Reimbursement</option>
                            <option value="rejected">Reject Claim</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Internal Remarks</label>
                        <textarea name="remarks" rows="3" placeholder="Explain the reason for rejection or special approval notes..." class="w-full bg-slate-800 border border-white/5 rounded-2xl px-4 py-3 text-white outline-none focus:ring-1 focus:ring-indigo-500 resize-none"></textarea>
                    </div>
                </div>

                <div class="flex gap-4 pt-10">
                    <button type="button" @click="openAuditModal = false" class="flex-1 py-4 bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs uppercase tracking-widest rounded-2xl transition-all">Cancel</button>
                    <button type="submit" class="flex-1 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs uppercase tracking-widest rounded-2xl shadow-xl shadow-indigo-600/30 transition-all">Submit Audit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
