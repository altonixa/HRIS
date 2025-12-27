@extends('layouts.admin')

@section('header', 'Define Salary Structure')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('hr-manager.salaries.index') }}" class="text-slate-400 hover:text-white text-sm flex items-center gap-1 mb-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Salaries
        </a>
        <h1 class="text-2xl font-bold text-white">New Salary Structure</h1>
        <p class="text-slate-400 text-sm">Configure base pay, allowances, and deductions.</p>
    </div>

    <form action="{{ route('hr-manager.salaries.store') }}" method="POST" id="salaryForm">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Basic Info & Components -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Employee Selection -->
                <div class="bg-slate-800 rounded-xl border border-white/5 p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Employee Details</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Select Employee</label>
                            <select name="employee_id" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors" required>
                                <option value="">-- Choose Employee --</option>
                                @foreach($employees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }} ({{ $emp->employee_code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 uppercase mb-2">Base Salary (XAF)</label>
                            <input type="number" name="base_salary" id="base_salary" placeholder="0.00" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-primary transition-colors text-lg font-mono" required oninput="calculateNetSalary()">
                        </div>
                    </div>
                </div>

                <!-- Earnings -->
                <div class="bg-slate-800 rounded-xl border border-white/5 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-white text-emerald-400 flex items-center gap-2">
                            <i data-lucide="plus-circle" class="w-5 h-5"></i> Allowances (Earnings)
                        </h3>
                        <button type="button" onclick="addComponent('earning')" class="text-xs bg-slate-700 hover:bg-slate-600 text-white px-3 py-1.5 rounded transition-colors">
                            + Add Allowance
                        </button>
                    </div>
                    <div id="earnings-container" class="space-y-3">
                        <!-- Dynamic Rows will appear here -->
                    </div>
                </div>

                <!-- Deductions -->
                <div class="bg-slate-800 rounded-xl border border-white/5 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-white text-rose-400 flex items-center gap-2">
                            <i data-lucide="minus-circle" class="w-5 h-5"></i> Deductions
                        </h3>
                        <button type="button" onclick="addComponent('deduction')" class="text-xs bg-slate-700 hover:bg-slate-600 text-white px-3 py-1.5 rounded transition-colors">
                            + Add Deduction
                        </button>
                    </div>
                    <div id="deductions-container" class="space-y-3">
                        <!-- Dynamic Rows will appear here -->
                    </div>
                </div>
            </div>

            <!-- Right Column: Summary -->
            <div class="lg:col-span-1">
                <div class="bg-slate-800 rounded-xl border border-white/5 p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-white mb-6">Salary Breakdown</h3>
                    
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between text-slate-400">
                            <span>Base Salary</span>
                            <span class="text-white font-mono" id="preview-base">0 XAF</span>
                        </div>
                        <div class="flex justify-between text-emerald-400">
                            <span>Total Earnings</span>
                            <span class="font-mono" id="preview-earnings">+0 XAF</span>
                        </div>
                        <div class="flex justify-between text-rose-400 border-b border-white/10 pb-4">
                            <span>Total Deductions</span>
                            <span class="font-mono" id="preview-deductions">-0 XAF</span>
                        </div>
                        <div class="flex justify-between items-end pt-2">
                            <span class="text-slate-300 font-bold">Net Salary</span>
                            <span class="text-2xl font-bold text-white font-mono" id="preview-net">0 XAF</span>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-white/5">
                        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white py-3 rounded-lg font-medium shadow-lg shadow-primary/25 transition-all flex items-center justify-center gap-2">
                            <i data-lucide="save" class="w-4 h-4"></i> Save Salary Structure
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<template id="component-row-template">
    <div class="grid grid-cols-12 gap-2 component-row items-center">
        <div class="col-span-6">
            <input type="text" name="components[INDEX][name]" placeholder="Name (e.g. Housing)" class="w-full bg-slate-900 border border-slate-700 rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-primary" required>
            <input type="hidden" name="components[INDEX][type]" class="component-type">
        </div>
        <div class="col-span-5">
            <input type="number" name="components[INDEX][amount]" placeholder="0.00" class="w-full bg-slate-900 border border-slate-700 rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-primary component-amount" required oninput="calculateNetSalary()">
        </div>
        <div class="col-span-1 text-center">
            <button type="button" onclick="removeRow(this)" class="text-slate-600 hover:text-rose-500 transition-colors">
                <i data-lucide="trash" class="w-4 h-4"></i>
            </button>
        </div>
    </div>
</template>

<script>
    let componentIndex = 0;

    function addComponent(type) {
        const container = document.getElementById(type === 'earning' ? 'earnings-container' : 'deductions-container');
        const template = document.getElementById('component-row-template').content.cloneNode(true);
        
        // Update inputs
        const inputs = template.querySelectorAll('input');
        inputs.forEach(input => {
            input.name = input.name.replace('INDEX', componentIndex);
            if (input.classList.contains('component-type')) {
                input.value = type;
            }
        });

        componentIndex++;
        container.appendChild(template);
        lucide.createIcons();
    }

    function removeRow(btn) {
        btn.closest('.component-row').remove();
        calculateNetSalary();
    }

    function calculateNetSalary() {
        const base = parseFloat(document.getElementById('base_salary').value) || 0;
        let earnings = 0;
        let deductions = 0;

        // Sum Earnings
        document.querySelectorAll('#earnings-container .component-amount').forEach(input => {
            earnings += parseFloat(input.value) || 0;
        });

        // Sum Deductions
        document.querySelectorAll('#deductions-container .component-amount').forEach(input => {
            deductions += parseFloat(input.value) || 0;
        });

        const net = base + earnings - deductions;

        // Update UI
        document.getElementById('preview-base').textContent = base.toLocaleString() + ' XAF';
        document.getElementById('preview-earnings').textContent = '+' + earnings.toLocaleString() + ' XAF';
        document.getElementById('preview-deductions').textContent = '-' + deductions.toLocaleString() + ' XAF';
        document.getElementById('preview-net').textContent = net.toLocaleString() + ' XAF';
    }
</script>
@endsection
