@extends('layouts.admin')

@section('header', 'Salary Structures')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-white mb-1">Employee Salaries</h1>
        <p class="text-slate-400 text-sm">Manage base salaries, allowances, and deductions.</p>
    </div>
    <a href="{{ route('hr-manager.salaries.create') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
        <i data-lucide="plus-circle" class="w-4 h-4"></i> Define Salary
    </a>
</div>

<div class="bg-slate-800 rounded-xl border border-white/5 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-400">
            <thead class="bg-slate-900/50 text-xs uppercase font-semibold text-slate-300">
                <tr>
                    <th class="px-6 py-4">Employee</th>
                    <th class="px-6 py-4">Base Salary</th>
                    <th class="px-6 py-4">Net Salary</th>
                    <th class="px-6 py-4">Components</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($salaries as $salary)
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold text-xs">
                                {{ substr($salary->employee->first_name, 0, 1) }}{{ substr($salary->employee->last_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-white font-medium">{{ $salary->employee->first_name }} {{ $salary->employee->last_name }}</div>
                                <div class="text-xs text-slate-500">{{ $salary->employee->designation->title ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-mono text-slate-300">
                        {{ number_format($salary->base_salary, 0) }} XAF
                    </td>
                    <td class="px-6 py-4 font-mono text-emerald-400 font-bold">
                        {{ number_format($salary->net_salary, 0) }} XAF
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($salary->components as $comp)
                                <span class="px-2 py-0.5 rounded text-[10px] uppercase font-bold
                                    {{ $comp->type === 'earning' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-rose-500/10 text-rose-400' }}">
                                    {{ $comp->name }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-slate-400 hover:text-white transition-colors">
                            <i data-lucide="edit-2" class="w-4 h-4"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                        No salary structures defined yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($salaries->hasPages())
    <div class="p-4 border-t border-white/5">
        {{ $salaries->links() }}
    </div>
    @endif
</div>
@endsection
