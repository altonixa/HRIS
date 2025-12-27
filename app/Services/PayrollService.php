<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\SalaryStructure;
use App\Models\Payroll;
use Carbon\Carbon;

class PayrollService
{
    /**
     * Calculate Tax and CNPS based on Cameroon standards (approximate)
     * CNPS usually 4.2% (employee part capped)
     * Tax (IRPP) is progressive.
     */
    public function calculateNet($baseSalary, $allowances = 0)
    {
        $grossTaxable = $baseSalary + $allowances;
        
        // Simplified CNPS (approx 4.2% capped at ~31,500 XAF)
        $cnps = min($grossTaxable * 0.042, 31500);
        
        // Simplified Tax (IRPP) - Example bracket
        $taxableBase = $grossTaxable - $cnps;
        $irpp = 0;
        if ($taxableBase > 62000) {
            $irpp = ($taxableBase - 62000) * 0.10; // Simple 10% above threshold
        }
        
        $totalDeductions = $cnps + $irpp;
        $net = $grossTaxable - $totalDeductions;
        
        return [
            'gross' => $grossTaxable,
            'cnps' => $cnps,
            'irpp' => $irpp,
            'net' => $net,
            'total_deductions' => $totalDeductions
        ];
    }

    public function generateMonthlyPayrollBatch($month)
    {
        $date = Carbon::parse($month)->startOfMonth();
        $employees = Employee::with('salaryStructure.components')->get();
        $count = 0;

        foreach ($employees as $employee) {
            if (!$employee->salaryStructure) continue;

            // Check if already exists
            $exists = Payroll::where('employee_id', $employee->id)
                ->where('month', $date)
                ->exists();
            
            if ($exists) continue;

            $base = $employee->salaryStructure->base_salary;
            $allowances = $employee->salaryStructure->components->where('type', 'earning')->sum('amount');
            $deductions = $employee->salaryStructure->components->where('type', 'deduction')->sum('amount');

            // Calculate automated deductions (Tax/CNPS)
            $calcs = $this->calculateNet($base, $allowances);
            
            $totalDeductions = $deductions + $calcs['total_deductions'];
            $net = ($base + $allowances) - $totalDeductions;

            Payroll::create([
                'employee_id' => $employee->id,
                'month' => $date,
                'base_salary' => $base,
                'total_allowances' => $allowances,
                'total_deductions' => $totalDeductions,
                'net_salary' => $net,
                'status' => 'processed',
            ]);
            
            $count++;
        }

        return $count;
    }
}
