@extends('layouts.admin')

@section('header', 'New Expense Submission')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-slate-900 border border-white/5 rounded-[40px] p-10 backdrop-blur-sm shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-purple-500"></div>
        
        <div class="mb-12">
            <h2 class="text-3xl font-black text-white tracking-tighter mb-2">Claim Reimbursement</h2>
            <p class="text-slate-500 text-sm font-bold uppercase tracking-widest">Submit valid business expenses for audit.</p>
        </div>

        <form action="{{ route('employee.expenses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Expense Title *</label>
                    <input type="text" name="title" required placeholder="e.g. Flight to Douala - Q1 Review" class="w-full bg-slate-800 border border-white/5 rounded-2xl px-6 py-4 text-white outline-none focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Category *</label>
                    <select name="category" required class="w-full bg-slate-800 border border-white/5 rounded-2xl px-6 py-4 text-white outline-none focus:ring-2 focus:ring-indigo-500 transition-all font-bold appearance-none">
                        <option value="Travel">Business Travel</option>
                        <option value="Meals">Meals & Entertainment</option>
                        <option value="Office">Office Supplies</option>
                        <option value="Equipment">Hardware/IT Equipment</option>
                        <option value="Medical">Medical/Insurance</option>
                        <option value="Telecom">Internet & Phone</option>
                        <option value="Other">Other Miscellaneous</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Amount (XAF) *</label>
                    <div class="relative">
                        <input type="number" name="amount" required step="0.01" placeholder="0.00" class="w-full bg-slate-800 border border-white/5 rounded-2xl px-6 py-4 text-white outline-none focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
                        <span class="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-600">XAF</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Expense Date *</label>
                    <input type="date" name="claim_date" required class="w-full bg-slate-800 border border-white/5 rounded-2xl px-6 py-4 text-white outline-none focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Justification / Description</label>
                <textarea name="description" rows="4" placeholder="Briefly explain the business purpose of this expense..." class="w-full bg-slate-800 border border-white/5 rounded-3xl px-6 py-4 text-white outline-none focus:ring-2 focus:ring-indigo-500 transition-all font-medium resize-none"></textarea>
            </div>

            <div class="space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Evidence / Receipt (Digital Archive)</label>
                <div class="relative group">
                    <input type="file" name="receipt" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="w-full bg-slate-800 border-2 border-dashed border-white/10 group-hover:border-indigo-500/50 rounded-3xl p-12 text-center transition-all">
                        <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center text-slate-500 mx-auto mb-4 group-hover:text-indigo-400 group-hover:scale-110 transition-all">
                            <i data-lucide="cloud-lightning" class="w-8 h-8"></i>
                        </div>
                        <p class="text-white font-black text-sm uppercase tracking-widest">Drop receipt or click to browse</p>
                        <p class="text-slate-500 text-xs mt-2 font-bold uppercase tracking-tighter">Accepted: PDF, JPG, PNG (Max 2MB)</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-10">
                <a href="{{ route('employee.expenses.index') }}" class="flex-1 py-5 bg-slate-800 hover:bg-slate-700 text-white font-black text-xs uppercase tracking-widest rounded-2xl text-center transition-all">
                    Discard Draft
                </a>
                <button type="submit" class="flex-1 py-5 bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl shadow-indigo-600/30 transition-all">
                    Initiate Claim
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
