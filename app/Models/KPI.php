<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KPI extends Model
{
    protected $table = 'kpis';

    protected $fillable = [
        'title',
        'description',
        'weight',
        'target_value',
        'unit',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
