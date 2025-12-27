<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary_structure_id',
        'name',
        'type',
        'amount',
        'is_percentage',
        'percentage_value',
    ];

    public function salaryStructure()
    {
        return $this->belongsTo(SalaryStructure::class);
    }
}
