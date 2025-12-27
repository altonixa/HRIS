@extends('layouts.admin')

@section('header', 'New Course Definition')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white border border-slate-200 rounded-xl p-10 shadow-sm relative overflow-hidden">
        
        <div class="mb-10">
            <h2 class="text-3xl font-black text-slate-900 tracking-tighter mb-2">Architect a new module</h2>
            <p class="text-purple-600 text-sm font-bold uppercase tracking-widest">Global Learning & Development Standards</p>
        </div>

        <form action="{{ route('hr-manager.courses.store') }}" method="POST" class="space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Universal Title</label>
                    <input type="text" name="title" required placeholder="Advanced Strategic Leadership" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Entity Code</label>
                    <input type="text" name="code" required placeholder="LDR-2025-01" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-bold">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Knowledge Category</label>
                    <select name="category" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-bold appearance-none">
                        <option value="Technical">Technical</option>
                        <option value="Soft Skills">Soft Skills</option>
                        <option value="Compliance">Compliance</option>
                        <option value="Safety">Safety</option>
                        <option value="Management">Management</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Delivery Provider</label>
                    <input type="text" name="provider" placeholder="Internal / Coursera" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Investment (Hours)</label>
                    <input type="number" name="duration_hours" placeholder="0" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-bold">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Syllabus Overview</label>
                <textarea name="description" rows="5" placeholder="Define the core learning objectives and intended outcomes..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-medium resize-none"></textarea>
            </div>

            <div class="flex gap-4 pt-6">
                <a href="{{ route('hr-manager.courses.index') }}" class="flex-1 py-4 bg-slate-50 hover:bg-slate-100 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl text-center border border-slate-200 transition-all">
                    Discard changes
                </a>
                <button type="submit" class="flex-1 py-4 bg-purple-600 hover:bg-purple-700 text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-sm transition-all">
                    deploy course catalog
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
