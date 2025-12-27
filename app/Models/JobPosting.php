<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPosting extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'requirements',
        'benefits',
        'department_id',
        'location',
        'employment_type',
        'salary_range',
        'status',
        'closing_date',
    ];

    protected $casts = [
        'closing_date' => 'date',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'Published');
    }
}
