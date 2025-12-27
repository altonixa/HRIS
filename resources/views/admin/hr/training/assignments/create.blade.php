@extends('layouts.admin')

@section('header', 'Deploy Training Program')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white border border-slate-200 rounded-xl p-10 shadow-sm relative overflow-hidden">
        
        <div class="mb-10 text-center">
            <h2 class="text-3xl font-black text-slate-900 tracking-tighter mb-2">Assign Learning Module</h2>
            <p class="text-purple-600 text-sm font-bold uppercase tracking-widest">Bridging the Workforce Skill Gap</p>
        </div>

        <form action="{{ route('hr-manager.trainings.store') }}" method="POST" class="space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Target Personnel</label>
                    <select name="employee_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-bold appearance-none">
                        <option value="">Select Employee...</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }} ({{ $employee->employee_code }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Course Module</label>
                    <select name="course_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-bold appearance-none">
                        <option value="">Select Course...</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }} [{{ $course->code }}]</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Proposed Start Date</label>
                    <input type="date" name="start_date" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Expected Completion</label>
                    <input type="date" name="end_date" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 text-slate-900 outline-none focus:ring-1 focus:ring-purple-600 transition-all font-bold">
                </div>
            </div>

            <div class="flex gap-4 pt-6">
                <a href="{{ route('hr-manager.trainings.index') }}" class="flex-1 py-4 bg-slate-50 hover:bg-slate-100 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl text-center border border-slate-200 transition-all">
                    Cancel Operation
                </a>
                <button type="submit" class="flex-1 py-4 bg-purple-600 hover:bg-purple-700 text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-sm transition-all">
                    Confirm Assignment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
