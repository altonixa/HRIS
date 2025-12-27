<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payroll Report - {{ date('F Y', strtotime($month)) }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 3px solid #8b5cf6; padding-bottom: 15px; }
        .company-name { font-size: 22px; font-weight: bold; color: #8b5cf6; }
        .report-title { font-size: 16px; font-weight: bold; margin-top: 8px; }
        .report-period { font-size: 12px; color: #666; margin-top: 5px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background-color: #8b5cf6; color: white; padding: 8px; text-align: left; font-size: 10px; font-weight: bold; }
        td { padding: 6px; border-bottom: 1px solid #ddd; font-size: 10px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        
        .summary { margin-top: 25px; padding: 15px; background-color: #f0f0f0; border-left: 4px solid #8b5cf6; }
        .summary-item { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .summary-label { font-weight: bold; }
        .summary-value { color: #8b5cf6; font-weight: bold; }
        
        .footer { margin-top: 30px; text-align: center; font-size: 9px; color: #666; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">ALTONIXA HRIS</div>
        <div class="report-title">MONTHLY PAYROLL REPORT</div>
        <div class="report-period">{{ date('F Y', strtotime($month)) }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee</th>
                <th>Department</th>
                <th>Base Salary</th>
                <th>Allowances</th>
                <th>Gross salary</th>
                <th>Deductions</th>
                <th>Net Salary</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalGross = 0;
                $totalDeductions = 0;
                $totalNet = 0;
            @endphp
            @foreach($payrolls as $payroll)
            @php
                $gross = $payroll->base_salary + $payroll->total_allowances;
                $totalGross += $gross;
                $totalDeductions += $payroll->total_deductions;
                $totalNet += $payroll->net_salary;
            @endphp
            <tr>
                <td>{{ $payroll->employee->employee_code }}</td>
                <td>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</td>
                <td>{{ $payroll->employee->department->name ?? 'N/A' }}</td>
                <td>{{ number_format($payroll->base_salary, 0) }}</td>
                <td>{{ number_format($payroll->total_allowances, 0) }}</td>
                <td>{{ number_format($gross, 0) }}</td>
                <td>{{ number_format($payroll->total_deductions, 0) }}</td>
                <td><strong>{{ number_format($payroll->net_salary, 0) }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <div class="summary-item">
            <span class="summary-label">Total Employees:</span>
            <span class="summary-value">{{ $payrolls->count() }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Gross Pay:</span>
            <span class="summary-value">{{ number_format($totalGross, 0) }} FCFA</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Deductions:</span>
            <span class="summary-value">{{ number_format($totalDeductions, 0) }} FCFA</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Net Pay:</span>
            <span class="summary-value">{{ number_format($totalNet, 0) }} FCFA</span>
        </div>
    </div>

    <div class="footer">
        <p>Generated on {{ now()->format('F d, Y \a\t H:i') }}</p>
        <p>&copy; {{ date('Y') }} Altonixa Group Ltd. All rights reserved.</p>
    </div>
</body>
</html>
