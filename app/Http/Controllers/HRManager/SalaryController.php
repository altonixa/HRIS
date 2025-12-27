<?php

namespace App\Http\Controllers\HRManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\SalaryStructure;
use App\Models\SalaryComponent;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = SalaryStructure::with('employee')->latest()->paginate(15);
        return view('admin.hr.salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::doesntHave('salaryStructure')->get();
        return view('admin.hr.salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id|unique:salary_structures,employee_id',
            'base_salary' => 'required|numeric|min:0',
            'components' => 'nullable|array',
            'components.*.name' => 'required|string',
            'components.*.type' => 'required|in:earning,deduction',
            'components.*.amount' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            // Calculate Net Salary
            $base = $request->base_salary;
            $totalEarnings = 0;
            $totalDeductions = 0;

            if ($request->has('components')) {
                foreach ($request->components as $comp) {
                    if ($comp['type'] === 'earning') {
                        $totalEarnings += $comp['amount'];
                    } else {
                        $totalDeductions += $comp['amount'];
                    }
                }
            }

            $net = $base + $totalEarnings - $totalDeductions;

            $structure = SalaryStructure::create([
                'employee_id' => $request->employee_id,
                'base_salary' => $base,
                'net_salary' => $net,
                'currency' => 'XAF', // Default for now
            ]);

            if ($request->has('components')) {
                foreach ($request->components as $comp) {
                    $structure->components()->create([
                        'name' => $comp['name'],
                        'type' => $comp['type'],
                        'amount' => $comp['amount'],
                    ]);
                }
            }
        });

        return redirect()->route('hr-manager.salaries.index')
            ->with('success', 'Salary structure defined successfully.');
    }
}
