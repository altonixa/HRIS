@extends('layouts.admin')

@section('header', 'Add New Asset')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-slate-900 border border-white/5 rounded-[40px] p-10 backdrop-blur-sm shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-purple-500"></div>
        
        <div class="mb-12">
            <h2 class="text-3xl font-black text-white tracking-tighter mb-2 italic">Register Hardware</h2>
            <p class="text-slate-500 text-sm font-bold uppercase tracking-widest leading-none">Add new equipment to the company digital inventory.</p>
        </div>

        <form action="{{ route('hr-manager.assets.store') }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Asset Name *</label>
                    <input type="text" name="name" required placeholder="e.g. MacBook Pro M3" class="w-full bg-slate-800 border border-white/5 rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Unique Asset Code *</label>
                    <input type="text" name="asset_code" required placeholder="e.g. AST-LT-001" class="w-full bg-slate-800 border border-white/5 rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Category *</label>
                    <select name="category" required class="w-full bg-slate-800 border border-white/5 rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all font-bold appearance-none">
                        <option value="Laptop/PC">Laptop/PC</option>
                        <option value="Mobile/Tablet">Mobile/Tablet</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Networking">Networking Gear</option>
                        <option value="Vehicle">Vehicle</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Serial Number</label>
                    <input type="text" name="serial_number" placeholder="e.g. SN12345678" class="w-full bg-slate-800 border border-white/5 rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Purchase Date</label>
                    <input type="date" name="purchase_date" class="w-full bg-slate-800 border border-white/5 rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Warranty Expiry</label>
                    <input type="date" name="warranty_expiry" class="w-full bg-slate-800 border border-white/5 rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Asset Value (XAF)</label>
                    <input type="number" name="value" step="0.01" placeholder="0.00" class="w-full bg-slate-800 border border-white/5 rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Technical Specifications / Description</label>
                <textarea name="description" rows="4" placeholder="RAM, Storage, Condition notes..." class="w-full bg-slate-800 border border-white/5 rounded-3xl px-6 py-4 text-white focus:ring-2 focus:ring-indigo-500 transition-all font-medium resize-none"></textarea>
            </div>

            <div class="flex gap-4 pt-10">
                <a href="{{ route('hr-manager.assets.index') }}" class="flex-1 py-5 bg-slate-800 hover:bg-slate-700 text-white font-black text-xs uppercase tracking-widest rounded-2xl text-center transition-all">
                    Discard
                </a>
                <button type="submit" class="flex-1 py-5 bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl shadow-indigo-600/30 transition-all">
                    Register Asset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
