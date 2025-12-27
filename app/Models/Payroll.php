<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory, \App\Traits\Auditable;

    protected $fillable = [
        'employee_id',
        'month',
        'base_salary',
        'total_allowances',
        'total_deductions',
        'net_salary',
        'status',
        'payment_date',
    ];

    protected $casts = [
        'month' => 'date',
        'payment_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
