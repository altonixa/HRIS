<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'base_salary',
        'net_salary',
        'currency',
        'is_active',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function components()
    {
        return $this->hasMany(SalaryComponent::class);
    }
}
