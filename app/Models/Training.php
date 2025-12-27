<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'course_id',
        'start_date',
        'end_date',
        'completion_date',
        'score',
        'status',
        'certificate_path',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'completion_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
