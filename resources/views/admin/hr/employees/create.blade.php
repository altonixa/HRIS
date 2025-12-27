@extends('layouts.admin')

@section('header', 'Add Employee')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('hr-manager.employees.index') }}" class="text-slate-400 hover:text-white text-sm flex items-center gap-1 mb-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Employees
        </a>
        <h1 class="text-2xl font-bold text-white">New Employee</h1>
        <p class="text-slate-400 text-sm">Create a new employee profile and user account.</p>
    </div>

    <form action="{{ route('hr-manager.employees.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Section: Account -->
        <div class="bg-slate-800 rounded-xl border border-white/5 p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <i data-lucide="user-check" class="w-5 h-5 text-primary"></i> Account Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Full Name</label>
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="first_name" placeholder="First Name" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                        <input type="text" name="last_name" placeholder="Last Name" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Email Address (Username)</label>
                    <input type="email" name="email" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                </div>
            </div>
        </div>

        <!-- Section: Work -->
        <div class="bg-slate-800 rounded-xl border border-white/5 p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <i data-lucide="briefcase" class="w-5 h-5 text-indigo-400"></i> Work Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Employee Code</label>
                    <input type="text" name="employee_code" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Joining Date</label>
                    <input type="date" name="joining_date" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                </div>
                 <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Department</label>
                    <select name="department_id" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors">
                        <option value="">Select Department</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Designation</label>
                    <select name="designation_id" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors">
                        <option value="">Select Designation</option>
                        @foreach($designations as $desig)
                            <option value="{{ $desig->id }}">{{ $desig->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex justify-end gap-3">
             <a href="{{ route('hr-manager.employees.index') }}" class="px-6 py-2.5 rounded-lg text-slate-400 hover:text-white font-medium transition-colors">Cancel</a>
             <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-6 py-2.5 rounded-lg font-medium shadow-lg shadow-primary/25 transition-all">
                 Create Employee
             </button>
        </div>
    </form>
</div>
@endsection
