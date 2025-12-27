<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payslip - {{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #8b5cf6; padding-bottom: 15px; }
        .company-name { font-size: 24px; font-weight: bold; color: #8b5cf6; margin-bottom: 5px; }
        .document-title { font-size: 18px; font-weight: bold; margin-top: 10px; }
        
        .info-section { margin-bottom: 20px; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .info-label { font-weight: bold; width: 150px; }
        .info-value { flex: 1; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #8b5cf6; color: white; padding: 10px; text-align: left; font-weight: bold; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        
        .total-row { font-weight: bold; background-color: #e9ecef !important; }
        .net-pay { font-size: 16px; background-color: #8b5cf6; color: white; padding: 15px; text-align: center; margin-top: 20px; }
        
        .footer { margin-top: 40px; text-align: center; font-size: 10px; color: #666; border-top: 1px solid #ddd; padding-top: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">ALTONIXA HRIS</div>
        <div style="font-size: 11px; color: #666;">Human Resources Information System</div>
        <div class="document-title">PAYSLIP</div>
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Employee Name:</span>
            <span class="info-value">{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Employee ID:</span>
            <span class="info-value">{{ $payroll->employee->employee_code }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Department:</span>
            <span class="info-value">{{ $payroll->employee->department->name ?? 'N/A' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Designation:</span>
            <span class="info-value">{{ $payroll->employee->designation->name ?? 'N/A' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Pay Period:</span>
            <span class="info-value">{{ \Carbon\Carbon::parse($payroll->month)->format('F Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Payment Date:</span>
            <span class="info-value">{{ $payroll->payment_date ? \Carbon\Carbon::parse($payroll->payment_date)->format('M d, Y') : 'Pending' }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Earnings</th>
                <th style="text-align: right;">Amount (FCFA)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Basic Salary</td>
                <td style="text-align: right;">{{ number_format($payroll->base_salary, 0) }}</td>
            </tr>
            <tr>
                <td>Allowances</td>
                <td style="text-align: right;">{{ number_format($payroll->total_allowances, 0) }}</td>
            </tr>
            <tr class="total-row">
                <td>Gross Pay</td>
                <td style="text-align: right;">{{ number_format($payroll->base_salary + $payroll->total_allowances, 0) }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>Deductions</th>
                <th style="text-align: right;">Amount (FCFA)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Statutory Deductions (Tax & CNPS)</td>
                <td style="text-align: right;">{{ number_format($payroll->total_deductions, 0) }}</td>
            </tr>
            <tr class="total-row">
                <td>Total Deductions</td>
                <td style="text-align: right;">{{ number_format($payroll->total_deductions, 0) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="net-pay">
        NET SALARY: {{ number_format($payroll->net_salary, 0) }} FCFA
    </div>

    <div class="footer">
        <p>This is a computer-generated payslip and does not require a signature.</p>
        <p>&copy; {{ date('Y') }} Altonixa Group Ltd. All rights reserved.</p>
    </div>
</body>
</html>
