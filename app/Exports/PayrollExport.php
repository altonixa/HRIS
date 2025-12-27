<?php

namespace App\Exports;

use App\Models\Payroll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PayrollExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    public function collection()
    {
        return Payroll::with(['employee.department', 'employee.designation'])
            ->whereYear('month', date('Y', strtotime($this->month)))
            ->whereMonth('month', date('m', strtotime($this->month)))
            ->get();
    }

    public function headings(): array
    {
        return [
            'Staff ID',
            'Full Name',
            'Department',
            'Designation',
            'Base Salary',
            'Total Allowances',
            'Total Deductions',
            'Net Salary',
            'Payment Date',
        ];
    }

    public function map($payroll): array
    {
        return [
            $payroll->employee->employee_code,
            $payroll->employee->first_name . ' ' . $payroll->employee->last_name,
            $payroll->employee->department->name ?? 'N/A',
            $payroll->employee->designation->name ?? 'N/A',
            $payroll->base_salary,
            $payroll->total_allowances,
            $payroll->total_deductions,
            $payroll->net_salary,
            $payroll->payment_date ? $payroll->payment_date->format('Y-m-d') : 'Pending',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8B5CF6']]],
        ];
    }
}
